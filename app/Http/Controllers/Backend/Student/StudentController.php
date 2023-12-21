<?php

namespace App\Http\Controllers\Backend\Student;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\AcademicClass;
use App\Models\Session;
use App\Models\Student;
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
        $request->validate([
            'roll'              => 'required',
            'name'              => 'required',
            'phone_number'      => 'required',
            'dob'               => 'required',
            'religion'          => 'required',
            'gender'            => 'required',
            'blood_group'       => 'required',
            'father_name'       => 'required',
            'mother_name'       => 'required',
            'guardian_phone'    => 'required',
            'district'          => 'required',
            'upazila'           => 'required',
            'post_office'       => 'required',
            'village'           => 'required',
            'session_id'        => 'required',
            'class_id'          => 'required',
            'image'             => 'mimes:jpeg,png,jpeg|max:5000'
        ]);

        // dd($request->all());

       $student = Student::create([
            'unique_id'         => Helper::studentUniqueId(),
            'roll'              => $request->roll,
            'name'              => $request->name,
            'phone_number'      => $request->phone_number,
            'dob'               => $request->dob,
            'religion'          => $request->religion,
            'gender'            => $request->gender,
            'blood_group'       => $request->blood_group,
            'father_name'       => $request->father_name,
            'mother_name'       => $request->mother_name,
            'guardian_phone'    => $request->guardian_phone,
            'district'          => $request->district,
            'upazila'           => $request->upazila,
            'post_office'       => $request->post_office,
            'village'           => $request->village,
            'session_id'        => $request->session_id,
            'class_id'          => $request->class_id,
            'group_id'          => $request->group_id,
            'section_id'        => $request->section_id,
        ]);

        if($request->hasFile('image')){
            $newFileName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move('storage/uploads/student/', $newFileName);
            $student->image = 'storage/uploads/student/'.$newFileName;
            $student->save();
        }

        toastr()->success('Student admitted successfully');
        return to_route('student.index');

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
