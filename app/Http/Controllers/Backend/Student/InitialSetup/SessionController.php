<?php

namespace App\Http\Controllers\Backend\Student\InitialSetup;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.student.setting.session');
    }

    public function getSessions()
    {
        $sessions = Session::where('status','active')->orderBy('id','desc')->get();
        return response()->json($sessions);
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
            'session_year' => 'required|unique:sessions',
        ]);

        Session::create([
            'session_year' => $request->session_year
        ]);

        return response()->json([
            'status' => 200,
            'message'=> 'Session create successfully',
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
        return Session::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'session_year' => 'required|unique:sessions,session_year,'.$request->id
        ]);

        Session::find($request->id)->update([
            'session_year' => $request->session_year
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Session update successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Session::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Session deleted successfully'
        ]);
    }
}
