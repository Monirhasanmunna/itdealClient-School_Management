<?php

namespace App\Http\Controllers\Backend\Subject;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function edit($class_id, $group_id = null)
    {
        $compulsory_subjects    = Subject::where('subject_type', 'Compulsory')->get();
        $optional_subjects      = Subject::where('subject_type', 'Optional')->get();
        $additional_subjects    = Subject::where('subject_type', 'Additional')->get();
        $elective_subjects      = Subject::where('subject_type', 'Elective')->get();


        $class = AcademicClass::with([
        'subjects' => function ($query) use ($group_id) {
            $query->where('class_subjects.group_id', $group_id);
        },

        'groups' => function($query) use ($group_id) {
            $query->where('group_id', $group_id);
        }
        ])->find($class_id);

        return view('backend.subject.assign-to-class',compact('class','compulsory_subjects','optional_subjects','additional_subjects','elective_subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = AcademicClass::find($id);

        DB::table('class_subjects')->where('class_id', $id)->where('group_id', $request->group)->delete();

        foreach ($request->subject_id as $subjectId) {
            $class->subjects()->attach($subjectId, ['group_id' => $request->group]);
        }

        toastr()->success('Subject assigned successfully');
        return to_route('subject.assign-to-class.index');
    }
}
