<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_about;
use Illuminate\Http\Request;

class BulsuAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $about = bulsu_about::all()->makeHidden(['created_at', 'updated_at']);

        return response()->json([
            'status' => 200,
            'abouts' => $about
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
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $about = bulsu_about::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $about
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($bulsu_about)
    {
        //
        $about = bulsu_about::where('id', $bulsu_about)->get();

        return response()->json([
            'status'=>'Success',
            'data'=> $about,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bulsu_about $bulsu_about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $bulsuAbout)
    {
        //
        $about = bulsu_about::find($bulsuAbout);

        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $about->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json([
            'status'=>'Success',
            'data'=> $about,
        ]);;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_about $bulsuAbout)
    {
        //
        $bulsuAbout->delete();

        return  response()->noContent();
    }

    public function __construct()
{
    $this->middleware('auth:sanctum')
        ->only([
            'destroy',
            'store',
            'update',
        ]);
}
}
