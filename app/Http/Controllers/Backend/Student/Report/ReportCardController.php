<?php

namespace App\Http\Controllers\Backend\Student\Report;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\FixedSubject;
use App\Models\Report;
use App\Models\Student;
use Illuminate\Http\Request;

class ReportCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = AcademicClass::all();
        return view('backend.student.report.index',compact('classes'));
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
    public function store($id)
    {
        $student = Student::find($id);
        $subjects = FixedSubject::all()->load('chapters');
        
        foreach ($subjects as $key => $subject) {
            $chapters = $subject->chapters;

            foreach ($chapters as $key => $chapter) {
                $report = new Report();
                $report->student_id = $student->id;
                $report->subject_id = $subject->id;
                $report->chapter_id = $chapter->id;
                $report->option1 = true;
                $report->option2 = true;
                $report->option3 = true;
                $report->option4 = true;
                $report->save();
            }
        }

        toastr()->success('Report generate successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function print(string $id)
    {
        $student = Student::find($id)->load('reports.subject');
       return $student->reports->groupBy('subject.name');
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