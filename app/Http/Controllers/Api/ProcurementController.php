<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\procurement;
use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $procurement = procurement::all();

        return response()->json([
            'status' => 'Success',
            'data' => $procurement
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
            'date' => 'required|date',
            'publisher' => 'required|string',
            'title'=> 'required|string',
            'body' => 'required|string',
            'document' => 'required|mimes:pdf,csv,xls,xlsx,doc,docx|max:10000',

        ]);

        $procurement_doc_path= $request->file('document')->store('procurement', 'public');

        $procurement = procurement::create([
            'date' => $request->date,
            'publisher' => $request->publisher,
            'title' => $request->title,
            'body' => $request->body,
            'document' => $procurement_doc_path,
        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $procurement
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(procurement $procurement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(procurement $procurement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, procurement $procurement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(procurement $procurement)
    {
        //
    }
}
