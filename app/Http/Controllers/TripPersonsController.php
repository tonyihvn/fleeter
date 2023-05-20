<?php

namespace App\Http\Controllers;

use App\Models\trip_persons;
use App\Http\Requests\Storetrip_personsRequest;
use App\Http\Requests\Updatetrip_personsRequest;

class TripPersonsController extends Controller
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
     * @param  \App\Http\Requests\Storetrip_personsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetrip_personsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\trip_persons  $trip_persons
     * @return \Illuminate\Http\Response
     */
    public function show(trip_persons $trip_persons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\trip_persons  $trip_persons
     * @return \Illuminate\Http\Response
     */
    public function edit(trip_persons $trip_persons)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetrip_personsRequest  $request
     * @param  \App\Models\trip_persons  $trip_persons
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetrip_personsRequest $request, trip_persons $trip_persons)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\trip_persons  $trip_persons
     * @return \Illuminate\Http\Response
     */
    public function destroy(trip_persons $trip_persons)
    {
        //
    }
}
