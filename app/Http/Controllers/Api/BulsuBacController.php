<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_bac;
use App\Models\bulsu_bac_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BulsuBacController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bac = bulsu_bac::all()->makeHidden(['id', 'created_at', 'updated_at']);

        if ($bac->count() > 0){
            return response()->json([
                'status' => 'Success',
                'data' => $bac
            ]);
        } else {
            return "No data to Retrieve";
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'title' => 'required|string',
            'doc_type' => 'required|string',
            'body' => 'required|string',
            'file' => 'required|mimes:pdf,csv,xls,xlsx,doc,docx|max:5120'
        ]);

        $docType = bulsu_bac_type::where('type_title', $request->doc_type)->first()->id;

        if ($request->hasFile('file')){
            $doc_name = $request->file->getClientOriginalName();
            $doc_path =$request->file->storeAs('procurement/attachment', $doc_name);

        } else {
            $doc_name = null;
        }

        $bac = bulsu_bac::create([
            'date' => $request->date,
            'title' => $request->title,
            'type_id' => $docType,
            'body' => $request->body,
            'file' => $doc_name

        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $bac
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(bulsu_bac $bac)
    {
        $bac = bulsu_bac::find($bac);

            return response()->json([
                'status' => 'Success',
                'data' => $bac
            ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bulsu_bac $bulsu_bac)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bulsu_bac $bac)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'title' => 'required|string',
            'doc_type' => 'required|string',
            'body' => 'required|string',
            'file' => 'required|mimes:pdf,csv,xls,xlsx,doc,docx|max:5120'
        ]);

        if($request->doc_type != null){
            $docType = bulsu_bac_type::where('type_title', $request->doc_type)->first()->id;
        }else {
            $docType= $bac->type_id;
        };


        if($request->hasFile('file')){
            if($bac->file != null){
                File::delete(storage_path('app/procurement/attachment/').$bac->file);
            }

            $attach_doc = $request->file;
            $doc_name = $attach_doc->getClientOriginalName();
            $location = storage_path('app/procurement/attachment');
            $attach_doc->move($location, $doc_name);

            $doc_path = $doc_name;
          
            
        } else {
            $doc_path = $bac->file;
        }

        $bac->update([
            'date' => $request->date,
            'title' => $request->title,
            'type_id' => $docType,
            'body' => $request->body,
            'file' => $doc_path

        ]);

        return response()->json([
            'status' => 'Success',
            'data' => $bac
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_bac $bulsu_bac)
    {
        //
    }
}
