<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'matricula' => 'nullable',
            'numero_carteira_motorista' => 'nullable',
            'password' => 'required',
            'user_type_id' => 'required|exists:user_types,id',
        ]);

        $user = User::create($data);

        return response()->json($user, 201);
    }
}
