<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Executive_Official;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExecutiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $executive = DB::table('bulsu_personnels')
        ->selectRaw('bulsu_personnels.name as name, bulsu_personnels.position as position, bulsu_personnels.image')
        ->join('executive_officials', 'bulsu_personnels.id', '=', 'executive_officials.bulsu_personnel_id')
        ->where('executive_officials.isActive', '=', '1')
        ->get();

        return response()->json([
            'data' => $executive
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
    public function show(Executive_Official $executive_Official)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Executive_Official $executive_Official)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Executive_Official $executive_Official)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Executive_Official $executive_Official)
    {
        //
    }
}
