<?php

namespace App\Http\Controllers\Backend\Student\InitialSetup;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.student.setting.section');
    }

    public function getSection()
    {
        $sections = Section::where('status','active')->orderBy('id','desc')->get();
        return response()->json($sections);
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

        Section::create([
            'name' => $request->name,
            'code' => Str::slug($request->name)
        ]);

        return response()->json([
            'status' => 200,
            'message'=> 'Section create successfully',
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
        return Section::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|unique:sections,name,'.$request->id
        ]);

        Section::find($request->id)->update([
            'name' => $request->name,
            'code' => Str::slug($request->name)
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Section update successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Section::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Section deleted successfully'
        ]);
    }
}
