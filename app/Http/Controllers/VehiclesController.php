<?php

namespace App\Http\Controllers;

use App\Models\vehicles;
use App\Models\facilities;

use App\Http\Requests\StorevehiclesRequest;
use App\Http\Requests\UpdatevehiclesRequest;
use Illuminate\Http\Request;

class VehiclesController extends Controller
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
        $facilities = facilities::select('facility_name','state','id')->get();
        return view('new-vehicle')->with(['facilities'=>$facilities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorevehiclesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'picture'=>'image|mimes:jpg,png,jpeg,gif,svg,webp'
        ]);

        if(!empty($request->file('picture'))){
            $file_name = time().'.'.$request->picture->extension();

            $request->picture->move(\public_path('vehicles/'),$file_name);
        }else{
                $file_name = "";
        }

        $data = request()->except(['facility']);
        $data['picture'] = $file_name;

        vehicles::create($data);

        return redirect()->back()->with(['message'=>"The Vehicle was recorded successfully!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function show(vehicles $vehicles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function edit(vehicles $vehicles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatevehiclesRequest  $request
     * @param  \App\Models\vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatevehiclesRequest $request, vehicles $vehicles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function destroy(vehicles $vehicles)
    {
        //
    }
}
