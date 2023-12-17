<?php

namespace App\Http\Controllers\Backend\Student\InitialSetup;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\Group;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        $groups = Group::all();
        return view('backend.student.setting.class',compact('sections','groups'));
    }

    public function getClass()
    {
        $classes = AcademicClass::with(['groups','sections'])->orderBy('id','desc')->get();
        return response()->json($classes);
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
        // return $request->all();
        $request->validate([
            'name' => 'required',
        ]);

        $class = AcademicClass::create([
            'name' => $request->name,
            'code' => Str::slug($request->name),
            'status' => 'active'
        ]);

        $class->groups()->attach($request->group_ids);
        $class->sections()->attach($request->section_ids);

        return response()->json([
            'status' => 200,
            'message' => 'Class created successfully'
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
