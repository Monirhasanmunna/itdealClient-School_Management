<?php

namespace App\Http\Controllers\Backend\Student\Lottery;

use App\Http\Controllers\Controller;
use App\Models\LotteryStudent;
use Illuminate\Http\Request;

class DrawLotteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.student.lottery.draw_lottery');
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
            'number_of_seat' => 'required'
        ]);

        $applicants = LotteryStudent::where('isSelected', false)->inRandomOrder()->take($request->number_of_seat)->select('id')->get();

        foreach ($applicants as $key => $applicant) {
           $student = LotteryStudent::find($applicant->id);
           $student->isSelected = true;
           $student->save();
        }

        return response()->json([
            'status' => 200
        ]);
        
    }


    public function getSelectedApplicant()
    {
        $selectedApplicants = LotteryStudent::where('isSelected',true)->get();

        $allId = $selectedApplicants->map(function($item){
            return $item['id'];
        });

        return response()->json([  
           'applications' => $selectedApplicants,
           'allId' => $allId
        ]);
    }

    public function lotteryResult()
    {
        return view('backend.student.lottery.lottery_result');
    }

    public function getRejectedApplicant()
    {
        $rejectedApplicants = LotteryStudent::where('isSelected',false)->get();
        return response()->json($rejectedApplicants);
    }

    public function SelectedStudentInfo($id)
    {
        $selectedApplicants = LotteryStudent::where('isSelected',true)->where('id',$id)->first();
        return response()->json($selectedApplicants);
    }

}
