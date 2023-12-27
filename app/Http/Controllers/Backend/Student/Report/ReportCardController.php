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
                $randomNumber = rand(4, 7);
                $report = new Report();
                $report->student_id = $student->id;
                $report->subject_id = $subject->id;
                $report->chapter_id = $chapter->id;

                for ($i=1; $i <= $randomNumber; $i++) { 
                    $propertyName = 'option' . $i;
                    $report->$propertyName = true;
                }
               
                $report->save();
            }
        }

        return response()->json([
            'status' => 200,
            'message'=> 'Report card created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function print(string $id)
    {
        $stdnt = Student::with(['class','section','group','session'])->find($id);

        $student = Student::find($id);
        
        $reports = $student->load(['reports.subject','reports.chapter'])->reports->groupBy('subject.name');
    
        return view('backend.student.report.reportCard',compact('reports','stdnt'));
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
