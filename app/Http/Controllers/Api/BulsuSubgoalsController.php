<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_subGoal;
use App\Models\bulsu_goal;
use Illuminate\Http\Request;

class BulsuSubgoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subgoal = bulsu_subGoal::get();

        return response()->json([
            'data'=> $subgoal
        ]);
    }

    public function showSubGoal($id)
    {
        $goal = bulsu_goal::find($id);

        $subgoal = bulsu_subGoal::where('goal_id', $goal->id)->get();

        return response()->json([
            'data'=> $subgoal
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
    public function show(bulsu_subGoal $bulsu_subGoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bulsu_subGoal $bulsu_subGoal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bulsu_subGoal $bulsu_subGoal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_subGoal $bulsu_subGoal)
    {
        //
    }
}
