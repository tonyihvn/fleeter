<?php

namespace App\Http\Controllers;

use App\Models\trips;
use App\Http\Requests\StoretripsRequest;
use App\Http\Requests\UpdatetripsRequest;

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
    public function store(StoretripsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\trips  $trips
     * @return \Illuminate\Http\Response
     */
    public function show(trips $trips)
    {
        //
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
    public function update(UpdatetripsRequest $request, trips $trips)
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
