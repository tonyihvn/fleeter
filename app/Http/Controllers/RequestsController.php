<?php

namespace App\Http\Controllers;

use App\Models\requests;
use App\Models\trip_persons;
use App\Models\trips;

use App\Models\facilities;
use App\Models\vehicles;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use App\Mail\requestApprovalMail;

use Illuminate\Http\Request;
// use Mail;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allrequests = requests::all();
        $vehicles = vehicles::select('id','brand','model','reg_no','status','condition')->get();
        return view('requests')->with(['allrequests'=>$allrequests,'vehicles'=>$vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $facilities = facilities::select('facility_name','id')->get();
        return view('new-request')->with(['facilities'=>$facilities]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorerequestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->fromid != '' && $request->toid != ''){
            $from_geocord = facilities::find($request->fromid)->geocordinates;
            $to_geocord = facilities::find($request->toid)->geocordinates;
        }else{
            $from_geocord = '';
            $to_geocord = '';
        }
        $rid = requests::create([
            'from'=>$request->from,
            'to'=>$request->to,
            'from_geocord'=>$from_geocord,
            'to_geocord'=>$to_geocord,
            'expdeparture_timedate'=>$request->expdeparture_timedate,
            'exparrival_timedate'=>$request->exparrival_timedate,
            'purpose'=>$request->purpose,
            'status'=>'Waiting for Approval',
            'requested_by'=>Auth()->user()->id
        ])->id;

        foreach ($request->persons as $key => $staff) {
            trip_persons::create([
                'request_id'=>$rid,
                'person_id'=>$staff
            ]);
        }


        $data = [
            'from'=>$request->from,
            'to'=>$request->to,
            'expdeparture_timedate'=>$request->expdeparture_timedate,
            'exparrival_timedate'=>$request->exparrival_timedate,
            'purpose'=>$request->purpose,
            'sender'=>Auth()->user()->name,
            'request_id'=>$rid
        ];
        $to_email = User::select('email')->where('id',Auth()->user()->supervisor)->first()->email;


        Mail::to($to_email)->send(new requestApprovalMail($data));

        $message = "Vehicle Request Sent Successfully!";
        return redirect()->back()->with(['message'=>$message]);
    }

    public function updateRequest(Request $request)
    {
        if($request->fromid != '' && $request->toid != ''){
            $from_geocord = facilities::find($request->fromid)->geocordinates;
            $to_geocord = facilities::find($request->toid)->geocordinates;
        }else{
            $from_geocord = '';
            $to_geocord = '';
        }
        requests::where('id',$request->id)->update([
            'from'=>$request->from,
            'to'=>$request->to,
            'from_geocord'=>$from_geocord,
            'to_geocord'=>$to_geocord,
            'expdeparture_timedate'=>$request->expdeparture_timedate,
            'exparrival_timedate'=>$request->exparrival_timedate,
            'purpose'=>$request->purpose,
            'requested_by'=>$request->requested_by
        ]);

        foreach ($request->persons as $key => $staff) {
            $check_existence = trip_persons::where('person_id',$staff)->where('request_id',$request->id)->first();
            if(!isset($check_existence)){
                trip_persons::create([
                    'request_id'=>$request->id,
                    'person_id'=>$staff
                ]);
            }
        }


        $data = [
            'from'=>$request->from,
            'to'=>$request->to,
            'expdeparture_timedate'=>$request->expdeparture_timedate,
            'exparrival_timedate'=>$request->exparrival_timedate,
            'purpose'=>$request->purpose,
            'sender'=>User::find($request->requested_by)->name,
            'request_id'=>$request->id
        ];

        $to_email = User::find($request->requested_by)->email;


        Mail::to($to_email)->send(new requestApprovalMail($data));

        $message = "Vehicle Request Updated Successfully!";
        return redirect()->back()->with(['message'=>$message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show(requests $requests)
    {
        //
    }

    public function editRequest($rid)
    {
        $request = requests::where('id',$rid)->first();
        $facilities = facilities::select('facility_name','id')->get();
        return view('edit-request')->with(['request'=>$request,'facilities'=>$facilities]);
    }

    public function approveRequest($rid)
    {
        $request = requests::where('id',$rid)->first();
        $request->status = 'Approved by '.Auth()->user()->name;
        $request->approved_by = Auth()->user()->id;
        $request->save();

        return redirect()->back()->with(['message'=>'The selected request has been approved successfully!']);
    }

    public function disapproveRequest($rid)
    {
        $request = requests::where('id',$rid)->first();
        $request->status = 'Disapproved by '.Auth()->user()->name;
        $request->approved_by = Auth()->user()->id;
        $request->save();

        return redirect()->back()->with(['message'=>'The selected request has been disapproved successfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\requests  $requests
     * @return \Illuminate\Http\Response
     */

    public function tripPersons($rid){
        $trip = requests::where('id',$rid)->first();
        $trip_persons = trip_persons::where('request_id',$rid)->get();

        return view('trip-persons')->with(['trip_persons'=>$trip_persons,'trip'=>$trip]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(requests $requests)
    {
        //
    }
}
