<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Models\UserRide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return [
            "status" => 1,
            "data" => $rides,
        ];
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create(Request $request)
    {
        $ride = new Ride;
        $ride->datetime = $request->datetime;
        $ride->passengers = 0;
        $ride->vagas = $request->vagas;
        $ride->from_adress = $request->rua . ', ' . $request->numero . ', ' . $request->bairro . ', ' . $request->cidade;
        $ride->to_adress = $request->rua . ', ' . $request->numero . ', ' . $request->bairro . ', ' . $request->cidade;
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
            'datetime' => 'required',
            'vagas' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
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
        return [
            "status" => 1,
            "data" =>$ride
        ];
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
            'datetime' => 'required',
            'vagas' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'status' => 'required',
        ]);
 
        $ride->update($request->all());
 
        return [
            "status" => 1,
            "data" => $ride,
            "message" => "The ride was updated successfully"
        ];
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
        return [
            "status" => 1,
            "data" => $ride,
            "message" => "The ride ended successfully"
        ];
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
