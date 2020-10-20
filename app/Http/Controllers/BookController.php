<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'publication_id' => 'required|number',
        ]);

        $data['author_id'] = auth()->user()->author->id;

        if (Book::create($data)) {
            return response(['status' => 'success', 'message' => 'Book creation success!'], 201);
        } else {
            return response(['status' => 'error', 'message' => 'Book creation failed!'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $book;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'name' => 'string|max:191',
            'publication_id' => 'number',
        ]);

        if ($book->update($data)) {
            return response(['status' => 'success', 'message' => 'Book update success!'], 204);
        } else {
            return response(['status' => 'error', 'message' => 'Book update failed!'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->delete()) {
            return response(['status' => 'success', 'message' => 'Book delete success!'], 204);
        } else {
            return response(['status' => 'error', 'message' => 'Book delete failed!'], 500);
        }
    }
}
