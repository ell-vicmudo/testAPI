<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_bac_type;
use Illuminate\Http\Request;

class BulsuBacTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bacType = bulsu_bac_type::all()->makeHidden(['id', 'created_at', 'updated_at']);

        if ($bacType->count() > 0){
            return response()->json([
                'status' => 'Success',
                'data' => $bacType
            ]);
        } else {
            return "No data to Retrieve";
        }
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
        $this->validate($request, [
            'doc_type' => 'string'
        ]);

        $bacType = bulsu_bac_type::create([
            'type_title' => $request->doc_type
        ])->makeHidden(['id', 'created_at', 'updated_at']);

        return response()->json([
            'status' => 'Successfully created',
            'data' => $bacType
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(bulsu_bac_type $bulsu_bac_type)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bulsu_bac_type $bulsu_bac_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bulsu_bac_type $bacType)
    {
        $this->validate($request, [
            'doc_type' => 'string'
        ]);

        $bacType->update(['type_title' => $request->doc_type]);

        return response()->json([
            'status' => 'Updated Successfully',
            'data' => $bacType
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_bac_type $bacType)
    {
        $bacType->delete();

        return response()->noContent();
    }

    public function __construct()
    {
        $this->middleware('auth:sanctum')
            ->only([
                'store',
                'index',
                'update',
                'destroy'
            ]);
    }
}
