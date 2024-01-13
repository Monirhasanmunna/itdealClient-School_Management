<?php

namespace App\Http\Controllers\Backend\Expense;

use App\Http\Controllers\Controller;
use App\Models\ExpCategory;
use App\Models\ExpSubCategory;
use Illuminate\Http\Request;

class ExpenseSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ExpCategory::where('status', 'active')->get();

        return view('backend.expense.sub-category.index',compact('categories'));
    }

    public function getExpenseSubCategory()
    {
        $subcategories = ExpSubCategory::with('category')->orderByDesc('id')->get();
        return response()->json($subcategories);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category'  => 'required',
            'name'      => 'required|unique:exp_sub_categories',
            'note'      => 'max:100'
        ]);

        ExpSubCategory::create([
            'category_id'   => $request->category,
            'name'          => $request->name,
            'note'          => $request->note,
        ]);

        return response()->json([
            'status'    => 200,
            'message'   => 'Sub category created successfully'
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
        return ExpSubCategory::with('category')->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'category'  => 'required',
            'name'      => 'required|unique:exp_sub_categories,name,'. $request->id,
            'note'      => 'max:100'
        ]);

        ExpSubCategory::find($request->id)->update([
            'category_id'   => $request->category,
            'name'          => $request->name,
            'note'          => $request->note,
            'status'        => $request->status,
        ]);

        return response()->json([
            'status'    => 200,
            'message'   => 'Sub category updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ExpSubCategory::find($id)->delete();
        return response()->json([
            'status'    => 200,
            'message'   => 'Sub category deleted successfully'
        ]);
    }
}
