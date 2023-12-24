<?php

namespace App\Http\Controllers\Backend\Subject;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectToClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.subject.class_subjects');
    }


    public function getAssignedSubject()
    {
        $classes = AcademicClass::with(['groups','subjects'])->orderBy('id','ASC')->get();
        return response()->json($classes);
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
        $compulsory_subjects = Subject::where('subject_type', 'Compulsory')->get();
        $optional_subjects = Subject::where('subject_type', 'Optional')->get();
        $additional_subjects = Subject::where('subject_type', 'Additional')->get();
        $elective_subjects = Subject::where('subject_type', 'Elective')->get();

        $class = AcademicClass::with('groups')->find($id);

        return view('backend.subject.assign-to-class',compact('class','compulsory_subjects','optional_subjects','additional_subjects','elective_subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request->all();

        $class = AcademicClass::find($id);

        foreach ($request->subject_id as $key => $subjectId) {
            $class->subjects()->attach($subjectId, ['group_id' => $request->group]);
        }

        toastr()->success('Subject assigned successfully');
        return to_route('subject.assign-to-class.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
