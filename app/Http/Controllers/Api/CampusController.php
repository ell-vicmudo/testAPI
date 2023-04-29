<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class CampusController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campus = Campus::select('campus_name')->get();

        return $this->success(
          $campus
        );

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
        $campus = Campus::create([
            'campus_name' => $request->name,
            'campus_overview' => $request->overview,
            'campus_contact_number' =>$request->contact_no
        ]);

        return $this->success($campus);
    }

    /**
     * Display the specified resource.
     */
    public function show(Campus $campus)
    {
        return $campus;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campus $campus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campus $campus)
    {
        $campus->update([
            'campus_name' => $request->name,
            'campus_overview' => $request->overview,
            'campus_contact_number' => $request->contact_no
        ]);

        return $this->success($campus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campus $campus)
    {
        $campus->delete();

        return response()->noContent();
    }
}
