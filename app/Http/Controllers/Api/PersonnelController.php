<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_personnel;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class PersonnelController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $personnel = bulsu_personnel::all();

        return response()->json([
            'data' => $personnel
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $personnel = new bulsu_personnel;

        $personnel->employee_number = $request->input('employeeNumber');
        $personnel->name = $request->input('name');
        $personnel->position = $request->input('position');
        
        $personnel->save();

        return response('User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(bulsu_personnel $bulsu_personnel)
    {
        //
    }

    /**
     * Show the  form for editing the specified resource.
     */
    public function edit(bulsu_personnel $bulsu_personnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bulsu_personnel $bulsu_personnel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_personnel $bulsu_personnel)
    {
        //
    }
}
