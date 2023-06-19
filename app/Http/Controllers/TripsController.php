<?php

namespace App\Http\Controllers;

use App\Models\trips;
use App\Models\mtrips;
use App\Models\routes;
use App\Models\vehicles;
use App\Models\trip_reports;

use App\Models\requests;
use App\Models\User;
use Pusher\Pusher;

use Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\approvedTripMail;
use Response;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth()->user()->role=="Super" || Auth()->user()->role=="Admin"){
            $trips = trips::all();
            $title = 'All Trips';
        }elseif(Auth()->user()->role=="Driver"){
            $trips = trips::where('driver_id',Auth()->user()->id)->get();
            $title = 'My Trips';
        }else{
            $trips = trips::where('requested_by',Auth()->user()->id)->get();
            $title = 'My Trips';
        }

        return view('trips')->with(['trips'=>$trips,'title'=>$title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretripsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = requests::where('id',$request->request_id)->first();

        trips::create([
            'from'=>$req->from,
            'to'=>$req->to,
            'from_geocord'=>$req->from_geocord,
            'to_geocord'=>$req->to_geocord,
            'departure_timedate'=>$req->expdeparture_timedate,
            'arrival_timedate'=>$req->exparrival_timedate,
            'request_id'=>$req->id,
            'vehicle_id'=>$request->vehicle_id,
            'driver_id'=>$request->driver_id,
            'type'=>$request->type,
            'remarks'=>$request->remarks,
            'status'=>'Driver and Vehicle Assigned'
        ]);

        $req->status='Driver and Vehicle Assigned';
        $req->save();

        $data = [
            'name'=>User::find($req->requestedBy->id)->name,
            'from'=>$req->from,
            'to'=>$req->to,
            'ttime'=>$req->expdeparture_timedate,
            'atime'=>$req->exparrival_timedate,
            'driver'=>User::find($request->driver_id)->name,
            'vehicle'=>User::find($request->vehicle_id)->regno,
            'type'=>$request->type,
            'remarks'=>$request->remarks,
        ];
        $to_email = User::find($req->requested_by)->email;

        Mail::to($to_email)->send(new approvedTripMail($data));

        $message = "Vehicle and Driver assigned successfully!";
        return redirect()->back()->with(['message'=>$message]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\trips  $trips
     * @return \Illuminate\Http\Response
     */
    public function driverTrips()
    {
        if(Auth()->user()->role=="Driver"){
            $trips = trips::where('driver_id',Auth()->user()->id)->where('status','!=','Completed')->get();
        }else{

             $trips = trips::all();
        }

        return view('driver-trips')->with(['trips'=>$trips]);
    }

    public function drive(Request $request){

        if($request->type=="dstart" || $request->type=="mstart" || $request->type=="rstart"){
            $currentInfo = "Driving to ";
        }else{
            $currentInfo = "Stopped at ";
        }

        $tripinfo = trips::select('id','vehicle_id','from', 'to','status')->where('id',$request->tripid)->first();
        $vehicle_id = $tripinfo->vehicle_id;
        $destination = $tripinfo->to;

        if($request->type=="mstart" || $request->type=="mstop"){
            $destination = mtrips::find($request->mtripid)->destination;
        }

        if($request->type=="rstart" || $request->type=="rstop"){
            $destination = $destination = $tripinfo->from;
        }

        if($request->type=="rstop"){
            $status = 'Completed';
            $currentInfo = "Trip Completed, Returned to ";
            User::find(Auth::user()->id)->update(['status' => 'Available']);
            vehicles::where('id',$vehicle_id)->update(['status' => 'Available','odometer' => $request->odometer]);

            $tripinfo->update(['status' => 'Completed']);
            routes::where('trip_id',$tripinfo->id)->update(['status' => 'Completed']);
        }else{
            $status = 'Active';
            User::find(Auth::user()->id)->update(['status' => 'On a Trip']);
            vehicles::where('id',$vehicle_id)->update(['status' => 'On a Trip','odometer' => $request->odometer]);
        }

        routes::create([
            'type'=>$request->type,
            'geocord'=>$request->geocord,
            'destination'=>$destination,
            'timedate'=>date("Y-m-d H:m"),
            'trip_id'=>$request->tripid,
            'status'=>$status,
            'odometer'=>$request->odometer,
            'vehicle_id'=>$tripinfo->vehicle_id
        ]);


        $message = "Status: ".$currentInfo." ".$destination;
        return Response::json(['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\trips  $trips
     * @return \Illuminate\Http\Response
     */

    public function trip($tripid)
    {
        $trip = trips::where('id',$tripid)->with('report','tripRoutes')->first();
        $tripRoutes = routes::where('trip_id',$tripid)->get();
        $report = trip_reports::where('trip_id',$tripid)->get();
        return view('trip')->with(['trip'=>$trip,'tripRoutes'=>$tripRoutes,'report'=>$report]);
    }
    public function newTripReport($tripid)
    {
        $trip = trips::select('id','arrival_timedate','to','vehicle_id')->where('id',$tripid)->first();
        return view('new-tripreport')->with(['trip'=>$trip]);
    }



    public function saveTripreport(Request $request){


        trip_reports::create([
            'details'=>$request->details,
            'timedate'=>date("Y-m-d H:m"),
            'trip_id'=>$request->trip_id,
            'status'=>'Submitted',
            'submited_by'=>Auth()->user()->id
        ]);
        return redirect()->route('trips')->with(['message'=>'Your trip report has been submitted successfully!']);

    }
    //LIVE MAP TRACKING

    public function liveTracker($tripid)
    {
        $trip = trips::where('id',$tripid)->first();
        return view('tripmap')->with(['trip'=>$trip]);
    }

    public function updateLocation(Request $request)
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'encrypted' => true
            ]
        );

        $location = [
            'lat' => $request->latitude,
            'lng' => $request->longitude,
            'user_id' => $request->user_id,
            'trip_id' => $request->trip_id
        ];

        $pusher->trigger('location-channel', 'update-location', $location);



        return response()->json(['success' => true]);
    }

    public function startTrip($tripid)
    {
        $trip = trips::where('id',$tripid)->first();

        return view('active-trip')->with(['trip'=>$trip]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetripsRequest  $request
     * @param  \App\Models\trips  $trips
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, trips $trips)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\trips  $trips
     * @return \Illuminate\Http\Response
     */
    public function destroy(trips $trips)
    {
        //
    }
}
