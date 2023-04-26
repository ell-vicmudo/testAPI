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
        //
        // $personnel = bulsu_personnel::select([
        //      'bulsu_personnels.employee_number',
        //      'bulsu_personnels.name',
        //      'bulsu_personnels.position',
        //      'departments.office_name',
        //      'campuses.campus_name',
        //      'bulsu_personnels.id'
        //     ])->join('departments', 'departments.id', '=', 'bulsu_personnels.department_id')
        //     ->join('campuses', 'campuses.id', '=', 'bulsu_personnels.campus_id')
        //     ->get();

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

        
        if($request->hasFile('image')){
            // $personnelImage = time() . '.' . $request->image->extension();
            // $image_path= $request->image->storeAs('personnelImage', $personnelImage, 'public');
            // $image_name = time().'.'.$request->image->extension();
            $image_name = uniqid().'-'.$request->name.'.'.$request->image->extension();
            $image_path = $request->image->storeAs('personnelImage', $image_name);

        } else {
            $image_path= null;
        };
        
        if($request->department != null){
            $department = Department::where('office_name', $request->department)->first()->id;
        }else {
            $department= null;
        };
        
        if($request->campus != null){
        $campus = Campus::where('campus_name', $request->campus)->first()->id;
        }else {
            $campus= null;
        };

        $personnel = bulsu_personnel::create([
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
            $personnel
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show($bulsuPersonnel)
    {
        //
        $personnel = bulsu_personnel::find($bulsuPersonnel);

        if(!$personnel){
            return $this->error('','Id not found',404);
        }else{
            return $this->success($personnel);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonnelRequest $request, $bulsuPersonnel)
    {
        //Retrieve specific info
        $personnel = bulsu_personnel::find($bulsuPersonnel);

        if(!$personnel){
            return $this->error('','Id not found',404);
        }else{
            
        $request->validated($request->all());


        // For image Update
        if($request->hasFile('image')){

            $image          = $request->file('image');
            $image_name   = uniqid().'-'.$request->name.'.'.$request->image->extension();
            $location       = storage_path('/app/personnelImage');
            $image->move($location, $image_name);

            //$OldImage = storage_path('app/'.$personnel->image);
           
            $image_path = 'personnelImage/'.$image_name;
            File::delete(storage_path('app/'). $personnel->image);
        } else {
          $image_path=$personnel->image;
        }
    
        //department
        if($request->department != null){
            $department = Department::where('office_name', $request->department)->first()->id;
        }else {
            $department= null;
        };
        
        //campus
        if($request->campus != null){
        $campus = Campus::where('campus_name', $request->campus)->first()->id;
        }else {
            $campus= null;
        };

        $personnel->update([
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
            $personnel
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
