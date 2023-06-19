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
        $vehicles = vehicles::all();
        return view('vehicles')->with(['vehicles'=>$vehicles]);
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
    public function show($vid)
    {
        $vehicle = vehicles::where('id',$vid)->first();
        return view('vehicle')->with(['vehicle'=>$vehicle]);
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
    public function update(Request $request)
    {
        $vehicle = vehicles::where('id',$request->vid)->first();
        $vehicle->condition = $request->condition ?? '';
        $vehicle->fuel_level = $request->fuel_level ?? '';
        $vehicle->odometer = $request->odometer ?? '';
        $vehicle->save();

        $message = "The vehicle was updated successfully!";
        return redirect()->back()->with(['message'=>$message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vehicles  $vehicles
     * @return \Illuminate\Http\Response
     */
    public function destroy($vid)
    {
        vehicles::find($vid)->delete();
        $message = "The vehicle was deleted successfully!";
        return redirect()->back()->with(['message'=>$message]);
    }
}
