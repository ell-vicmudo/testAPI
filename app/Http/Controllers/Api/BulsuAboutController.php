<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_about;
use Illuminate\Http\Request;

class BulsuAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $about = bulsu_about::get();

        return response()->json([
            'data' => $about
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
    public function show(bulsu_about $bulsu_about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bulsu_about $bulsu_about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bulsu_about $bulsu_about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_about $bulsu_about)
    {
        //
    }
}
