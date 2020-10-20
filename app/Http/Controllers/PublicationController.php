<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Publication::all();
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
            'name' => 'required|string|max:191'
        ]);

        if (Publication::create($data)) {
            return response(['status' => 'success', 'message' => 'Publcation creation success!'], 201);
        } else {
            return response(['status' => 'error', 'message' => 'Publcation creation failed!'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        return $publication;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        $data = $request->validate([
            'name' => 'string|max:191'
        ]);

        if ($publication->update($data)) {
            return response(['status' => 'success', 'message' => 'Author update success!'], 204);
        } else {
            return response(['status' => 'error', 'message' => 'Publcation update failed!'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        if ($publication->delete()) {
            return response(['status' => 'success', 'message' => 'Publication delete success!'], 204);
        } else {
            return response(['status' => 'error', 'message' => 'Publication delete failed!'], 500);
        }
    }
}
