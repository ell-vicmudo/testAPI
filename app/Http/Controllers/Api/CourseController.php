<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_course;
use App\Models\bulsu_college;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = bulsu_course::all();

        return response()->json([
            'status'=>'Success',
            'data' => $courses,
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
            'course' => 'required|string',
            'college_name' => 'required|string',
        ]);

        $college = bulsu_college::where('college_name', $request->college_name)->first()->id;

        $course = bulsu_course::create([
            'course_title' => $request->course,
            'college_id' => $college,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $course
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(bulsu_course $bulsu_course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bulsu_course $bulsu_course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bulsu_course $bulsu_course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_course $bulsu_course)
    {
        //
    }
}
