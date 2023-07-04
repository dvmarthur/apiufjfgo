<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;

    public function index()
    {
        $users = User::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $users,
        ];
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::once($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
    
            return response()->json([
                'status' => 1,
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ]);
        }
    
        return response()->json([
            'status' => 0,
            'message' => 'Invalid credentials'
        ], 401);
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
        $data['password'] = bcrypt($data['password']);
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
            "data" => $user
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
