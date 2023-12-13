<?php

namespace App\Http\Controllers\Backend\Student\InitialSetup;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.student.setting.group');
    }

    public function getGroup()
    {
        $group = Group::orderBy('id','desc')->get();
        return response()->json($group);
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
            'name' => 'required|unique:sections',
        ]);

        Group::create([
            'name' => $request->name,
            'code' => Str::slug($request->name)
        ]);

        return response()->json([
            'status' => 200,
            'message'=> 'Group create successfully',
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
        return Group::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|unique:groups,name,'.$request->id
        ]);

        Group::find($request->id)->update([
            'name' => $request->name,
            'code' => Str::slug($request->name)
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Group update successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Group::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Group deleted successfully'
        ]);
    }
}
