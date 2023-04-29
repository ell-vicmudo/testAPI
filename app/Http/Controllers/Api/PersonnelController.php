<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_personnel;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Department;
use App\Models\Campus;
use App\Http\Requests\PersonnelRequest;
use Illuminate\Support\Facades\File;

class PersonnelController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personnel = bulsu_personnel::all();

        if($personnel->count() > 0){
            return $this->success(
                $personnel
            );
        }else{
            return $this->error('', 'No Data to Retrieve!', 404);
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonnelRequest $request)
    {
        
        $request->validated($request->all());

        //Bulsu Personnel to save Images
        if($request->hasFile('image')){
            $image_name = $request->image->getClientOriginalName();
            $image_path = $request->image->storeAs('personnelImage', $image_name);

        } else {
            $image_path= null;
        };
        //Retrieve Department ID
        if($request->department != null){
            $department = Department::where('office_name', $request->department)->first()->id;
        }else {
            $department= null;
        };
        //Retrieve Campus ID
        if($request->campus != null){
        $campus = Campus::where('campus_name', $request->campus)->first()->id;
        }else {
            $campus= null;
        };
        //Create Command
        $personnel = bulsu_personnel::create([
            'employee_number' => $request->employee_number,
            'name'            => $request->name,
            'position'        => $request->position,
            'contact_no'      => $request->contact_no,
            'email'           => $request->email,
            'image'           => $image_path,
            'department_id'   => $department,
            'campus_id'       => $campus,
        ]);
        return $this->success($message = $personnel->name.' added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(bulsu_personnel $bulsuPersonnel)
    {
            return $bulsuPersonnel;     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonnelRequest $request, bulsu_personnel $bulsuPersonnel)
    {

        if(!$bulsuPersonnel){
            return $this->error('','Id not found',404);
        }else{
            
        $request->validated($request->all());


        // For image Update
        if($request->hasFile('image')){

            if($request->image != null){
                File::delete(storage_path('app/personnelImage/'). $bulsuPersonnel->image);
            }

            $image          = $request->file('image');
            $image_name     = $request->image->getClientOriginalName();
            $location       = storage_path('/app/personnelImage');
            $image->move($location, $image_name);       
            $image_path     = $image_name;
            
        } else {
          $image_path=$bulsuPersonnel->image;
        }
    
        //department
        if($request->department != null){
            $department = Department::where('office_name', $request->department)->first()->id;
        }else {
            $department= $bulsuPersonnel->department_id;
        };
        
        //campus
        if($request->campus != null){
        $campus = Campus::where('campus_name', $request->campus)->first()->id;
        }else {
            $campus= $bulsuPersonnel->campus_id;
        };

        $bulsuPersonnel->update([
            'employee_number' => $request->employee_number,
            'name' => $request->name,
            'position' => $request->position,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'image' => $image_path,
            'department_id' => $department,
            'campus_id' => $campus,
        ]);
        

        return $this->success([
            $bulsuPersonnel
        ]);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_personnel $bulsuPersonnel)
    {
        $bulsuPersonnel->delete();

        return response()->noContent();
    }

    public function __construct()
{
    $this->middleware('auth:sanctum')
        ->only([
            'index',
            'store',
            'show',
            'update',
            'destroy'
        ]);
}
    
}
