<?php

namespace App\Http\Controllers\Backend\Subject;

use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\Subject;
use Illuminate\Http\Request;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = AcademicClass::all();
        
        return view('backend.subject.index',compact('classes'));
    }


    public function getSubject()
    {
        $subjects = Subject::orderBy('id','DESC')->get();
        return response()->json($subjects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|unique:subjects',
            'subject_type'  => 'required',
            'subject_code'  => 'required|unique:subjects'
        ]);


        Subject::create([
            'name' => $request->name,
            'subject_type' => $request->subject_type,
            'subject_code' => $request->subject_code,
        ]);

        return response()->json([
            'status' => 200,
            'message'=> 'Subject created successfully'
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
        $subject = Subject::with('class')->find($id);

        return response()->json($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // return $request->all();

        $request->validate([
            'name'          => 'required|unique:subjects,name,'. $request['data_id'],
            'subject_type'  => 'required',
            'subject_code'  => 'required|unique:subjects,subject_type,'. $request['data_id']
        ]);

        Subject::find($request['data_id'])->update([
            'name' => $request->name,
            'subject_type' => $request->subject_type,
            'subject_code' => $request->subject_code,
        ]);

        return response()->json([
            'status' => 200,
            'message'=> 'Subject updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subject::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message'=> 'Subject deleted successfully'
        ]);
    }
}
