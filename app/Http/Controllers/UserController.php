<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $users,
        ];
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'matricula' => 'required',
            'cnh' => 'nullable',
            'password' => 'required',
            'photo' => 'required',
            'curso' => 'required',
            'phone' => 'required',
            'user_type_id' => 'required|exists:user_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $validator->validated();

        $user = User::create($data);

        return response()->json($user, 201);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return
     */
    public function show(User $user)
    {
        return [
            "status" => 1,
            "data" =>$user
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'matricula' => 'required',
            'phone' => 'required|phone|unique:users',
            'cnh' => 'nullable',
            'password' => 'required',
            'photo' => 'nullable',
            'curso' => 'required',
            'user_type_id' => 'required|exists:user_types,id',
        ]);

        $user->update($request->all());

        return [
            "status" => 1,
            "data" => $user,
            "message" => "Your data was updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return
     */
    public function destroy(User $user)
    {
        $user->delete();
        return [
            "status" => 1,
            "data" => $user,
            "message" => "Your account was deleted successfully"
        ];
    }
}