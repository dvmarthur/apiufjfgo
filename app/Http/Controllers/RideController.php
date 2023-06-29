<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Models\UserRide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

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
        $ride = new Ride;
        $ride->date = $request->date;
        $ride->time = $request->time;
        $ride->passengers = 0;
        $ride->vagas = $request->vagas;
        $ride->from = $request->from;
        $ride->destiny = $request->destiny;
        $ride->justWomen = $request->justWomen;
        $ride->driver_user_id = Auth::id();
        $ride->status = 'disponível';
        $ride->save();
        return response()->json([
            "message" => "ride created, and now avaluable for the passengers"
        ], 201);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */
    public function store(Request $request)
    {   
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'vagas' => 'required',
            'from' => 'required',
            'destiny' => 'required',
        ]);
 
        $ride = Ride::create($request->all());
        return [
            "status" => 1,
            "data" => $ride
        ];
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
            "status" => 1,
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
        ]);
 
        $ride->update($request->all());

        return response()->json([
            "status" => 1,
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
            "status" => 1,
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
