<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_personnel;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Department;
use App\Models\Campus;
use App\Http\Requests\PersonnelRequest;
use Illuminate\Support\Facades\Validator;

class PersonnelController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $personnel = bulsu_personnel::select([
             'bulsu_personnels.employee_number',
             'bulsu_personnels.name',
             'bulsu_personnels.position',
             'departments.office_name',
             'campuses.campus_name',
             'bulsu_personnels.id'
            ])->join('departments', 'departments.id', '=', 'bulsu_personnels.department_id')
            ->join('campuses', 'campuses.id', '=', 'bulsu_personnels.campus_id')
            ->get();;

        if($personnel->count() > 0){
            return $this->success([
                $personnel
            ]);
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
            $personnelImage = time() . '.' . $request->image->extension();
            $image_path= $request->image->storeAs('personnelImage', $personnelImage, 'public');
        } else {
            $image_path= null;
        };
        
        $department = Department::where('office_name', $request->department_name)->first()->id;
        $campus = Campus::where('campus_name', $request->campus)->first()->id;

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
    public function update(Request $request, int $bulsuPersonnel)
    {
        $validator = Validator::make($request->all(), [
            'employee_number' => 'string',
            'name' => 'string',
            'position' => 'string',
            'contact_no' => 'string',
            'email' => 'email',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'isActive' => 'boolean'
        ]);

        if($validator->fails()){
            return $this->error('', 'Error Input', 422);
        } else {

            $personnel = bulsu_personnel::find($bulsuPersonnel);

            //
            if($personnel) {

                //
                //$personnelImage='';
                if($request->hasFile('image')){
                    $personnelImage = time() . '.' . $request->image->extension();
                    $image_path= $request->image->storeAs('personnelImage', $personnelImage, 'public');
                        if ($personnel->image) {
                        Storage::delete('public/personnelImage'.$personnel->image);
                        }
                } else {
                    $personnelImage = $personnel->image;
                };
    
                $personnel->update([
                    'employee_number' => $request->employee_number,
                    'name' => $request->name,
                    'position'=> $request->position,
                    'contact_no' => $request->contact_no,
                    'email' => $request->email,
                    'isActive' => $request->isActive,
                    'image' => $personnelImage
                ]);

                return $this->success('','Successfully Updated');

            }else{
                return $this->error('', 'Failed to update', 500);
            }
            
        }

        // if(!$bulsuPersonnel) {
        //     return $this->error(null, 'Id not found', 404);
        // }
        
        // $request->validate([
        //     'employee_number' => 'string',
        //     'name' => 'string',
        //     'position' => 'string',
        //     'contact_no' => 'string',
        //     'email' => 'email',
        //     'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        //     'isActive' => 'boolean'
        // ]);

        // $personnel = $request->all();

        // $personnelImage = '';
        // if ($request->hasFile('image')) {
        //     $personnelImage = time() . '.' . $request->image->extension();
        //     $request->image->storeAs('public/images/bulsu_personnel', $personnelImage);
        //     if ($bulsuPersonnel->image) {
        //         Storage::delete('public/images/bulsu_personnel'.$bulsuPersonnel->image);
        //     }
        // } else {
        //     $personnelImage = $bulsuPersonnel->image;
        // }

        

        // $bulsuPersonnel->update($personnel);
        // $bulsuPersonnel->getChanges();

        // return $this->success($bulsuPersonnel);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_personnel $bulsuPersonnel)
    {
        $bulsuPersonnel->delete();

        return $this->success(null,null,204);
    }
}
