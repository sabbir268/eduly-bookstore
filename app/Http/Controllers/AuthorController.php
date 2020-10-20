<?php

namespace App\Http\Controllers;

use App\Author;
use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Author::all();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'password' => 'required|string|max:20|min:6',
        ]);

        $user = User::create([
            'email' =>  $request->email,
            'password' =>  bcrypt($request->password),
        ]);

        if ($user) {
            $author = Author::create([
                'name' => $request->name,
                'user_id' => $user->id,
            ]);
            if ($author) {
                $user->assignRole('admin');

                return response(['status' => 'success', 'message' => 'Author creation success!'], 201);
            }
        }

        return response(['status' => 'error', 'message' => 'Author creation failed!'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return $author;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'string|max:191',
            'email' => 'email|max:191',
        ]);

        if ($request->has('name')) {
            $author->update(['name' => $request->name]);
        }

        if ($request->has('email')) {
            $author->user()->update(['email' => $request->email]);
        }

        return response(['status' => 'success', 'message' => 'Author update success!'], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->delete()) {
            return response(['status' => 'success', 'message' => 'Author delete success!'], 204);
        } else {
            return response(['status' => 'error', 'message' => 'Author delete failed!'], 500);
        }
    }
}
