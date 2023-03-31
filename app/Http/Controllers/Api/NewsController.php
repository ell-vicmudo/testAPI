<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_news;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = bulsu_news::orderBy('publish_date','DESC')->get();

        return response()->json([
            'data' => $news
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

        $this->validate($request, [
            'title'=> 'required|string',
            'publisher'=> 'required|string',
            'publish_date'=> 'required|date',
            'heading'=> 'required|string',
            'body'=> 'required|string',
            'thumbnail'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $image_path= $request->file('thumbnail')->store('image', 'public');

        $news = bulsu_news::create([
            'title' => $request->title,
            'publisher'=> $request->publisher,
            'publish_date'=> $request->publish_date,
            'heading'=> $request->heading,
            'body'=> $request->body,
            'thumbnail' => $image_path,
        ]);
        

        return response()->json([
            'data'=>$news
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(bulsu_news $bulsu_news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bulsu_news $bulsu_news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bulsu_news $bulsu_news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_news $bulsu_news)
    {
        //
    }
}
