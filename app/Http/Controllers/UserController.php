<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:user, email|email',
            'password' => 'required|string|min:8'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);        
        $user = User::create($validatedData);

        return response()->json($user->id, 201);
    }
}
