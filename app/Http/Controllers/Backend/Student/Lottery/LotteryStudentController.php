<?php

namespace App\Http\Controllers\Backend\Student\Lottery;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Imports\StudentRegistrationImport;
use App\Models\LotteryStudent;
use App\Models\Session;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LotteryStudentController extends Controller
{

    public function index()
    {
        $applicants = LotteryStudent::orderBy('id','DESC')->get();
        return view('backend.student.lottery.student_entry',compact('applicants'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new StudentRegistrationImport, $request->file('file'));

        toastr()->success('Applicant Uploaded Successfully');
        return redirect()->back();
    }

}
