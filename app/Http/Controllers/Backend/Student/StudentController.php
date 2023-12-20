<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\Session;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = AcademicClass::all();
        return view('backend.student.index',compact('classes'));
    }

    public function getSectionAndGroupByClass($id)
    {
        $class = AcademicClass::with(['sections','groups'])->find($id);
        return response()->json($class);
    }

    public function studentFilter(Request $request)
    {
        $request->validate([
            'class' => 'required',
        ]);
        
        return $request->all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sessions = Session::all();
        $classes = AcademicClass::all();

        return view('backend.student.create',compact('sessions','classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
