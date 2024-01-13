<?php

namespace App\Http\Controllers\Backend\Expense;

use App\Http\Controllers\Controller;
use App\Models\ExpCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.expense.category.index');
    }

    public function getExpenseCategory()
    {
        $categories = ExpCategory::orderByDesc('id')->get();

        return response()->json($categories);
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
            'name' => 'required|unique:exp_categories',
            'note' => 'max:100'
        ]);

        ExpCategory::create([
            'name'  => $request->name,
            'note'  => $request->note,
        ]);

        return response()->json([
            'status' => 200,
            'message'=> 'Category Created Successfully',
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
        return ExpCategory::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:exp_categories,name,'. $request->id,
            'note' => 'max:100'
        ]);

        ExpCategory::find($request->id)->update([
            'name'  => $request->name,
            'note'  => $request->note,
            'status'=> $request->status
        ]);

        return response()->json([
            'status' => 200,
            'message'=> 'Category Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ExpCategory::find($id)->delete();

        return response()->json([
            'status' => 200,
            'message'=> 'Category Deleted Successfully',
        ]);
    }
}
