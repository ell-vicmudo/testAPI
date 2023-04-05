<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_personnel;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Department;
use App\Models\Campus;

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
            'status' => 'Success',
            'data' => $personnel
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $personnel = new bulsu_personnel;
        // $personnel->employee_number = $request->input('employeeNumber');
        // $personnel->name = $request->input('name');
        // $personnel->position = $request->input('position');     
        // $personnel->save();
        // return response('User created successfully.');

        $this->validate($request, [
            'employee_number' => 'required|string',
            'name' => 'required|string',
            'position' => 'required|string',
            'department_name' => 'string',
            'campus' => 'string',
            'contact_no' => 'string',
            'email' => 'email',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        
        $image_path= $request->file('image')->store('bulsu_personnel', 'public');
        $department = Department::where('office_name', $request->department_name)->first()->id;
        $campus = Campus::where('campus_name', $request->campus)->first()->id;

        $personnel = bulsu_personnel::create([
            'employee_number' => $request->employee_number,
            'name' => $request->name,
            'position' => $request->position,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'image' => $image_path,
            'department_id' => $department,
            'campus_id' => $campus,
        ]);

        return response()->json([
            'status' => 'Success',
            'data'=>$personnel
        ]);


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
