<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Models\UserRide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $rides = Ride::latest()->paginate(10);
        return response()->json([
            "data" => $rides
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'time' => 'required',
            'vagas' => 'required|integer',
            'from' => 'required',
            'destiny' => 'required',
            'justWomen' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $ride = new Ride([
            'date' => $request->date,
            'time' => $request->time,
            'passengers' => 0,
            'vagas' => $request->vagas,
            'from' => $request->from,
            'destiny' => $request->destiny,
            'justWomen' => $request->justWomen,
            'driver_id' => Auth::id(),
            'status' => 'disponível',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        try {
            $ride->save();   
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } catch (\Exception $e) {
            echo "Error: Could not add this record on the database" . $e->getMessage();
        }
        return response()->json($ride, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ride  $ride
     * @return
     */
    public function show(Ride $ride)
    {
        return response()->json([
            "data" => $ride
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ride  $ride
     * @return
     */
    public function update(Request $request, Ride $ride)
    {
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'vagas' => 'required',
            'status' => 'required',
            'justWomen' => 'required',
        ]);

        $ride->update($request->all());

        return response()->json([
            "data" => $ride,
            "message" => "The ride was updated successfully"
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ride  $ride
     * @return
     */
    public function destroy(Ride $ride)
    {
        $ride->delete();
        return response()->json([
            "data" => $ride,
            "message" => "The ride ended successfully"
        ], Response::HTTP_OK);
    }
    public function reservar(Request $request)
    {
        $ride = new UserRide();
        $ride->user_id = $request->user_id;
        $ride->ride_id = $request->ride_id;
        $ride->save();
        return response()->json([
            "message" => "ride reserved."
        ], 201);
    }
}