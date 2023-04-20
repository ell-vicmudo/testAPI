<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administrative_Offices;
use App\Models\bulsu_personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministrativeOfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $adminCouncil = DB::table('bulsu_personnels')
        ->selectRaw(
            'bulsu_personnels.name as name, bulsu_personnels.position as position, departments.office_name as department, administrative__offices.admin_offices as adminCategory'
        )
        ->join('departments', 'bulsu_personnels.department_id', '=', 'departments.id')
        ->join('administrative__offices', 'bulsu_personnels.id', '=', 'administrative__offices.bulsu_personnel_id')
        ->where('bulsu_personnels.isActive', '=', '1')
        ->get();

        return response()->json([
            'status' => 'Success',
            'data' => $adminCouncil
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
            "name" => 'required|string',
            "administrative_Offices" => 'required|string',
        ]);

        $personnel = bulsu_personnel::where('name', $request->name)->first()->id;

        $adminCouncil = Administrative_Offices::create([
            "bulsu_personnel_id" => $personnel,
            "admin_offices" => $request->administrative_Offices,
        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $adminCouncil
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($administrativeCouncil)
    {
        //
        $adminCouncil = DB::table('bulsu_personnels')
        ->selectRaw(
            'bulsu_personnels.name as name, bulsu_personnels.position as position, departments.office_name as department, administrative__offices.admin_offices as adminCategory'
        )
        ->join('departments', 'bulsu_personnels.department_id', '=', 'departments.id')
        ->join('administrative__offices', 'bulsu_personnels.id', '=', 'administrative__offices.bulsu_personnel_id')
        ->where('administrative__offices.id', '=', $administrativeCouncil)
        ->get();
        
        //Administrative_Offices::where('id', $administrativeCouncil)->get();

        if(is_null($adminCouncil)) {
            return response()->json([
                'status'=> 'Error',
                'message' => 'ID not found'
            ]);
        }

        return response()->json([
            'status' => 'Success',
            'data' => $adminCouncil
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrative_Offices $administrative_Offices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $administrativeCouncil)
    {
        //

        // $this->validate($request, [
        //     'name' => 'required|string',
        //     'adminCategory' => 'required|string',
        // ]);

        // $personnel = bulsu_personnel::where('name', $request->name)->first()->id;

        // $adminCouncil = Administrative_Officer::find($administrativeCouncil);

        // if(is_null($adminCouncil)) {
        //     return response()->json([
        //         'status'=> 'Error',
        //         'message' => 'ID not found'
        //     ]);
        // } else {
        //     $adminCouncil->update([
        //         'bulsu_personnel_id' => $personnel,
        //         'admin_offices' => $request->adminCategory
        //     ]);

        //     return response()->json([
        //         'status' => 'Success',
        //         'data' => $adminCouncil
        //     ]);
        // }


        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrative_Offices $administrative_Offices)
    {
        //
    }
}
