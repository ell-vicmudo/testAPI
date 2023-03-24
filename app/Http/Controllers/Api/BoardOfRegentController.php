<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Board_of_Regents;
use Illuminate\Http\Request;

class BoardOfRegentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $boardOfRegents = Board_of_Regents::get();

        return response()->json([
            'data'=> $boardOfRegents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Board_of_Regents $board_of_Regents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board_of_Regents $board_of_Regents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Board_of_Regents $board_of_Regents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board_of_Regents $board_of_Regents)
    {
        //
    }
}
