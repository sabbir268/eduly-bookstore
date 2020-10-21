<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|max:10|min:6',
        ]);

        $data['api_token'] = Str::random(60);

        if ($user = User::create($data)) {
            $user->assignRole('author');
            return response(['status' => 'success', 'message' => 'Author created successfully']);
        } else {
            return response(['status' => 'error', 'message' => 'Author create failed']);
        }
    }


    // public function refreshToken(){
        
    // }
    
}
