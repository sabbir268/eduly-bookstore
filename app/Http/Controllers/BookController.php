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
            'publication_id' => 'required|numeric',
        ]);

        $data['author_id'] = auth()->user()->hasRole('author') != false ? $request->author_id : auth()->user()->author->id;

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
            'publication_id' => 'numeric',
        ]);
        if (auth()->user()->hasRole('admin') || $book->author_id == auth()->user()->author->id) {
            if ($book->update($data)) {
                return response(['status' => 'success', 'message' => 'Book update success!'], 202);
            } else {
                return response(['status' => 'error', 'message' => 'Book update failed!'], 500);
            }
        } else {
            return response(['status' => 'error', 'message' => 'Not authorize'], 401);
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
        if (auth()->user()->hasRole('admin') || $book->author_id == auth()->user()->author->id) {
            if ($book->delete()) {
                return response(['status' => 'success', 'message' => 'Book delete success!'], 202);
            } else {
                return response(['status' => 'error', 'message' => 'Book delete failed!'], 500);
            }
        } else {
            return response(['status' => 'error', 'message' => 'Not authorize'], 401);
        }
    }


    public function changePublication(Request $request, Book $book)
    {
        if ($request->has('publication_id') && !empty($request->has('publication_id'))) {
            $book->update(['publication_id' => $request->author_id]);
            return response(['status' => 'success', 'message' => 'Book publication change success!'], 202);
        } else {
            return response(['status' => 'error', 'message' => 'Book publication change failed!'], 500);
        }
    }
}
