<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class DepartmentController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department = Department::all();

        return $this->success($department);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'string',
            'office_name' => 'required|string',
            'contact_no' => 'string'
        ]);

        $department = Department::create([
            'office_code' => $request->code,
            'office_name' => $request->office_name,
            'contact_number' => $request->contact_no
        ]);

        return $this->success($department);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return $department;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Department $department)
    {

        $this->validate($request, [
            'code' => 'string',
            'office_name' => 'string',
            'contact_no' => 'string'
        ]);

        $department->update([
            'office_code' => $request->code,
            'office_name' => $request->office_name,
            'contact_number' => $request->contact_no,
        ]);

        return $this->success($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response()->noContent();
    }

    public function __construct(){
        $this->middleware('auth:sanctum')
        ->only([
            'store',
            'show',
            'update',
            'destroy'
        ]);
    }
}
