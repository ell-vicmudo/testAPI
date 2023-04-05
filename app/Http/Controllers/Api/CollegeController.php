<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_college;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $college = bulsu_college::all();
        return response()->json([
            'status' => 'Success',
            'data' => $college
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
        $this->validate($request, [
            'abbreviation' => 'required|string',
            'name' => 'required|string',
        ]);

        $college = bulsu_college::create([
            'college_abbv' => $request->abbreviation,
            'college_name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $college
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(bulsu_college $bulsu_college)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bulsu_college $bulsu_college)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bulsu_college $bulsu_college)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_college $bulsu_college)
    {
        //
    }
}
