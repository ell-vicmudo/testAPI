<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administrative_Offices;
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
            'bulsu_personnels.name as name, bulsu_personnels.position, departments.office_name, administrative__offices.admin_offices'
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrative_Offices $administrative_Offices)
    {
        //
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
    public function update(Request $request, Administrative_Offices $administrative_Offices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrative_Offices $administrative_Offices)
    {
        //
    }
}
