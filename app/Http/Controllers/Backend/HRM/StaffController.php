<?php

namespace App\Http\Controllers\Backend\HRM;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\HrmDepartment;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = HrmDepartment::all();

        return view('backend.hrm.staffs.index',compact('departments'));
    }


    public function getStaff(Request $request)
    {
        $query = Staff::query();

        if($request->input('department')){
            $query->where('department_id', $request->department);
        }

        if($request->input('designation')){
            $query->where('designation_id', $request->designation);
        }

        $staffs = $query->with(['department', 'designation'])->orderByDesc('id')->get();
        return response()->json($staffs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = HrmDepartment::all();

        return view('backend.hrm.staffs.create',compact('departments'));
    }

    public function getDesignation($id)
    {
        $designations = HrmDepartment::find($id)->designations;
        return $designations;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'department'    => 'required',
            'designation'   => 'required',
            'name'          => 'required',
            'phone'         => 'required|unique:staff',
            'dob'           => 'required',
            'religion'      => 'required',
            'gender'        => 'required',
            'blood_group'   => 'required',
            'father_name'   => 'required',
            'mother_name'   => 'required',
            'district'      => 'required',
            'upazila'       => 'required',
            'post_office'   => 'required',
            'village'       => 'required',
            'image'         => 'mimes:jpeg,png,jpeg|max:5000'
        ]);


        $staff = new Staff();

        $staff->department_id   = $request->department;
        $staff->designation_id  = $request->designation;
        $staff->name            = $request->name;
        $staff->phone           = $request->phone;
        $staff->dob             = $request->dob;
        $staff->religion        = $request->religion;
        $staff->gender          = $request->gender;
        $staff->blood_group     = $request->blood_group;
        $staff->father_name     = $request->father_name;
        $staff->mother_name     = $request->mother_name;
        $staff->district        = $request->district;
        $staff->upazila         = $request->upazila;
        $staff->post_office     = $request->post_office;
        $staff->village         = $request->village;
        $staff->save();
        
        if($request->hasFile('image')){
            $newFileName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('storage/uploads/staff/', $newFileName);
            $staff->image = 'storage/uploads/staff/'.$newFileName;
            $staff->save();
        }

        toastr()->success('Staff Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments = HrmDepartment::all();
        $staff = Staff::with(['department','designation'])->find($id);
        return view('backend.hrm.staffs.edit',compact('departments','staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'department'    => 'required',
            'designation'   => 'required',
            'name'          => 'required',
            'phone'         => 'required|unique:staff,phone,'. $id,
            'dob'           => 'required',
            'religion'      => 'required',
            'gender'        => 'required',
            'blood_group'   => 'required',
            'father_name'   => 'required',
            'mother_name'   => 'required',
            'district'      => 'required',
            'upazila'       => 'required',
            'post_office'   => 'required',
            'village'       => 'required',
            'image'         => 'mimes:jpeg,png,jpeg|max:5000'
        ]);


        $staff = Staff::find($id);

        $staff->department_id   = $request->department;
        $staff->designation_id  = $request->designation;
        $staff->name            = $request->name;
        $staff->phone           = $request->phone;
        $staff->dob             = $request->dob;
        $staff->religion        = $request->religion;
        $staff->gender          = $request->gender;
        $staff->blood_group     = $request->blood_group;
        $staff->father_name     = $request->father_name;
        $staff->mother_name     = $request->mother_name;
        $staff->district        = $request->district;
        $staff->upazila         = $request->upazila;
        $staff->post_office     = $request->post_office;
        $staff->village         = $request->village;
        $staff->save();
        
        if($request->hasFile('image')){

            $oldImage = $staff->image;
            if(file_exists($oldImage)){
                unlink($oldImage);
            }

            $newFileName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('storage/uploads/staff/', $newFileName);
            $staff->image = 'storage/uploads/staff/'.$newFileName;
            $staff->save();
        }

        return response()->json([
            'status'   => 200,
            'message'  => 'Staff updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = Staff::find($id);

        $oldImage = $staff->image;
        if(file_exists($oldImage)){
            unlink($oldImage);
        }

        $staff->delete();

        return response()->json([
            'status' => 200,
            'message'=> 'staff deleted successfully'
        ]);
    }
}
