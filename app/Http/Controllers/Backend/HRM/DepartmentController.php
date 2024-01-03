<?php

namespace App\Http\Controllers\Backend\HRM;

use App\Http\Controllers\Controller;
use App\Models\HrmDepartment;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.hrm.department.index');
    }

    public function getDepartment()
    {
        $departments = HrmDepartment::orderBy('id', 'DESC')->get();

        return response()->json($departments);
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
        $request->validate([
            'name' => 'required|unique:hrm_departments',
        ]);

        HrmDepartment::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 200,
            'message'=> 'Department Created Successfully'
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
        return HrmDepartment::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:hrm_departments,name,'.$request->id,
        ]);

        HrmDepartment::find($request->id)->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'message'=> 'Department Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        HrmDepartment::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message'=> 'Department Deleted Successfully'
        ]);
    }
}
