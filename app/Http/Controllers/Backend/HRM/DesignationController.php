<?php

namespace App\Http\Controllers\Backend\HRM;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\HrmDepartment;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = HrmDepartment::all();
        return view('backend.hrm.designation.index',compact('departments'));
    }


    public function getDesignation()
    {
        $designations = Designation::with('department')->orderByDesc('id')->get();
        return response()->json($designations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'name'       => 'required|unique:designations',
            'description'=> 'max:120'
        ]);

        // return $request->all();

        Designation::create([
            'name'           => $request->name,
            'department_id'  => $request->department,
            'description'    => $request->description,
        ]);

        return response()->json([
            'status' => 200,
            'message'=>'Designation created successfully'
        ]);
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
        $designation = Designation::with('department')->find($id);
        return response()->json($designation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'name'       => 'required|unique:designations,name,'.$request->id,
            'description'=> 'max:120'
        ]);

        // return $request->all();

        Designation::find($request->id)->update([
            'name'           => $request->name,
            'department_id'  => $request->department,
            'description'    => $request->description,
            'status'         => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'message'=>'Designation updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Designation::find($id)->delete();
        return response()->json([
            'status' => 200,
            'message'=>'Designation deleted successfully'
        ]);
    }
}
