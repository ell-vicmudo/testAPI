<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\bulsu_personnel;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Department;
use App\Models\Campus;
use App\Http\Requests\PersonnelRequest;

class PersonnelController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $personnel = bulsu_personnel::all();

        
            return $this->success([
                $personnel
            ]);
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonnelRequest $request)
    {
        // $personnel = new bulsu_personnel;
        // $personnel->employee_number = $request->input('employeeNumber');
        // $personnel->name = $request->input('name');
        // $personnel->position = $request->input('position');     
        // $personnel->save();
        // return response('User created successfully.');





        // $this->validate($request, [
        //     'employee_number' => 'required|string',
        //     'name' => 'required|string',
        //     'position' => 'required|string',
        //     'department_name' => 'string',
        //     'campus' => 'string',
        //     'contact_no' => 'string',
        //     'email' => 'email',
        //     'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        // ]);



        $request->validated($request->all());

        
        if($request->hasFile('image')){
            $personnelImage = time() . '.' . $request->image->extension();
            $image_path= $request->image->storeAs('public/images/bulsu_personnel', $personnelImage);
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
    public function show(bulsu_personnel $bulsu_personnel)
    {
        //
    }

    /**
     * Show the  form for editing the specified resource.
     */
    public function edit(bulsu_personnel $bulsu_personnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bulsu_personnel $bulsuPersonnel)
    {
        

        // $personnelImage = '';
        // if ($request->hasFile('image')) {
        //     $personnelImage = time() . '.' . $request->image->extension();
        //     $request->file->storeAs('public/images/bulsu_personnel', $personnelImage);
        //     if ($bulsuPersonnel->image) {
        //         Storage::delete('public/images/bulsu_personnel'.$bulsuPersonnel->image);
        //     }
        // } else {
        //     $personnelImage = $bulsuPersonnel->image;
        // }

        
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bulsu_personnel $bulsu_personnel)
    {
        //
    }
}
