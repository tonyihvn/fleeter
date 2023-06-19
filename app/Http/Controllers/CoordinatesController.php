<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatesController extends Controller
{
    public function update(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Store the coordinates in the database or perform any other logic

        return response()->json(['success' => true]);
    }
}
