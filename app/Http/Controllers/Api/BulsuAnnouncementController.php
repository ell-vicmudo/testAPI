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
            $image_type = $request->image->getClientOriginalName();
            $image_path = $request->image->storeAs('announcement/image', $image_type);

            $image_name = $image_type;
        } else {
            $image_name = null;
        }

        if($request->hasFile('attachment')){
            $doc_type = $request->attachment->getClientOriginalName();
            $doc_path =$request->file('attachment')->storeAs('announcement/attachment', $doc_type);

            $doc_name = $doc_type;
        } else {
            $doc_name = null;
        }

        $announcement = bulsu_Announcement::create([
            'title' => $request->title,
            'publisher' => $request->publisher,
            'body' => $request->body,
            'date' => $request->date,
            'image' => $image_name,
            'attachment' => $doc_name
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
            if($announcement->image !=null){
                File::delete(storage_path('app/announcement/image/').$announcement->image);
            }
            
            $image = $request->file('image');
            //$image_name = Carbon::now()->format('YmdHs').'.'.$image->extension();
            $image_name = $image->getClientOriginalName();
            $location = storage_path('app/announcement/image');
            $image->move($location, $image_name);

            $image_path = $image_name;
            
        } else {
            $image_path = $announcement->image;
        }

        if($request->hasFile('attachment')){
            if($announcement->attachment != null){
                File::delete(storage_path('app/announcement/attachment/').$announcement->attachment);
            }

            $attach_doc = $request->file('attachment');
            //$doc_name = time().'-'.$attach_doc->getClientOriginalName();
            $doc_name = $attach_doc->getClientOriginalName();
            $location = storage_path('app/announcement/attachment');
            $attach_doc->move($location, $doc_name);

            $doc_path = $doc_name;
          
            
        } else {
            $doc_path = $announcement->attachment;
        }

        $announcement->update([
            'title' => $request->title,
            'publisher' => $request->publisher,
            'date' => $request->date,
            'body'=>$request->body,
            'image'=>$image_path,
            'attachment'=>$doc_path
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

    public function __construct()
{
    $this->middleware('auth:sanctum')
        ->only([
            'store',
            'show',
            'update',
            'destroy'
        ]);
}
}
