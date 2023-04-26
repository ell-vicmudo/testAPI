<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class BulsuAnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcement = bulsu_Announcement::all();
        return response()->json([
            'status'=>'success',
            'data'=>$announcement
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
            'title' => 'required|string',
            'publisher'=>'required|string',
            'body' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:10500',
            'attachment' => 'nullable|mimes:pdf,csv,xls,xlsx,doc,docx|max:5120'
        ]);

        if($request->hasFile('image')){
            $image_name = Carbon::now()->format('YmdHs').'.'.$request->image->extension();
            $image_path = $request->image->storeAs('announcement/image', $image_name);
        } else {
            $image_path = null;
        }

        if($request->hasFile('attachment')){
            $doc_name = time().'-'.$request->attachment->getClientOriginalName();
            $doc_path =$request->file('attachment')->storeAs('announcement/attachment', $doc_name);
        } else {
            $doc_path = null;
        }

        $announcement = bulsu_Announcement::create([
            'title' => $request->title,
            'publisher' => $request->publisher,
            'body' => $request->body,
            'date' => $request->date,
            'announcement_image' => $image_path,
            'announcement_attachment' => $doc_path
        ]);

        return response()->json([
            'status'=>'success',
            'data'=>$announcement
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(bulsu_Announcement $bulsu_Announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bulsu_Announcement $bulsu_Announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $bulsu_Announcement)
    {
        $this->validate($request, [
            'title' => 'sometimes|string',
            'publisher' => 'sometimes|string',
            'date' => 'sometimes|date',
            'body' => 'sometimes|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:10500',
            'attachment' => 'nullable|mimes:pdf,csv,xls,xlsx,doc,docx|max:5120'
        ]);

        $announcement = bulsu_Announcement::find($bulsu_Announcement);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = Carbon::now()->format('YmdHs').'.'.$image->extension();
            $location = storage_path('app/announcement/image');
            $image->move($location, $image_name);

            $image_path = 'announcement/image/'.$image_name;
            File::delete(storage_path('app/').$announcement->announcement_image);
        } else {
            $image_path = $announcement->announcement_image;
        }

        if($request->hasFile('attachment')){
            $attach_doc = $request->file('attachment');
            $doc_name = time().'-'.$attach_doc->getClientOriginalName();
            $location = storage_path('app/announcement/attachment');
            $attach_doc->move($location, $doc_name);

            $doc_path = 'announcement/image/'.$doc_name;
            File::delete(storage_path('app/').$announcement->announcement_attachment);
        } else {
            $doc_path = $announcement->announcement_attachment;
        }

        $announcement->update([
            'title' => $request->title,
            'publisher' => $request->publisher,
            'date' => $request->date,
            'body'=>$request->body,
            'announcement_image'=>$image_path,
            'announcement_attachment'=>$doc_path
        ]);

        return response()->json([
            'status'=>'success',
            'data'=>$announcement
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_Announcement $bulsu_Announcement)
    {
        //
    }
}
