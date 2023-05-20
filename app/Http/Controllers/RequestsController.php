<?php

namespace App\Http\Controllers;

use App\Models\requests;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('new-request');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorerequestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rid = requests::create([
            'from'=>$request->from,
            'to'=>$request->to,

            'expdeparture_timedate'=>$request->expdeparture_timedate,
            'exparrival_timedate'=>$request->exparrival_timedate,
            'purpose'=>$request->purpose,
            'status'=>'Not Approved',
            'requested_by'=>Auth()->user()->id
        ])->id;

        $data = $request;
        $supervisor = User::select('email','name')->where('id',Auth()->user()->supervisor)->first();

        $to_email = $supervisor->email;

        Mail::to($to_email)->send(new requestApprovalMail($data, $rid));

        $message = "Vehicle Request Sent Successfully!";
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(requests $requests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdaterequestsRequest  $request
     * @param  \App\Models\requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(UpdaterequestsRequest $request, requests $requests)
    {
        //
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
