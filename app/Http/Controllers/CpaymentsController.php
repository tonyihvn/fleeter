<?php

namespace App\Http\Controllers;

use App\Models\cpayments;
use App\Http\Requests\StorecpaymentsRequest;
use App\Http\Requests\UpdatecpaymentsRequest;

class CpaymentsController extends Controller
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
     * @param  \App\Http\Requests\StorecpaymentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecpaymentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cpayments  $cpayments
     * @return \Illuminate\Http\Response
     */
    public function show(cpayments $cpayments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cpayments  $cpayments
     * @return \Illuminate\Http\Response
     */
    public function edit(cpayments $cpayments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecpaymentsRequest  $request
     * @param  \App\Models\cpayments  $cpayments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecpaymentsRequest $request, cpayments $cpayments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cpayments  $cpayments
     * @return \Illuminate\Http\Response
     */
    public function destroy(cpayments $cpayments)
    {
        //
    }
}
