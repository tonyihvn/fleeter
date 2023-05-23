<?php

namespace App\Http\Controllers;

use App\Models\trips;
use App\Models\requests;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\approvedTripMail;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $trips = trips::where('driver_id',Auth()->user()->id)->get();
        }else{

             $trips = trips::all();
        }

        return view('driver-trips')->with(['trips'=>$trips]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\trips  $trips
     * @return \Illuminate\Http\Response
     */
    public function edit(trips $trips)
    {
        //
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
