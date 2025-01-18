<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::whereNull('parent_id')->with('subcategories')->get();
        return view('category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = new Category();
        $category->category_name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->status = 1;
        $execute = $category->save();

        if (!$execute) {
            return redirect()->route('categories.index')->with('error', 'Internal Server Error.Please Try Again Later!');
        }

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function storeAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }

        // Create the new category
        $category = new Category();
        $category->category_name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->status = 1;

        // Save the category
        $execute = $category->save();

        if (!$execute) {
            return response()->json(['error' => 'Internal Server Error. Please try again later.'], 500);
        }

        return response()->json(['status' => 'success','success' => 'Category created successfully.','category' => $category], 200);
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
        $category = Category::find($id);
        $categories = Category::whereNull('parent_id')->get();

        return response()->json([ 'category' => $category, 'categories' => $categories,]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error','errors' => $validator->errors(),], 422);
        }

        $category = Category::find($id);
        if (!$category) {
            return response()->json(['status' => 'error','message' => 'Category not found.',], 404);
        }
        $category->parent_id = $request->parent_id;
        $category->category_name = $request->name;
        $category->status = 1;
        $execute = $category->update();

        if (!$execute) {
            return response()->json(['status' => 'error','message' => 'Internal Server Error.',], 500);
        }

        return response()->json(['status' => 'success','message' => 'Category updated successfully.',]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['success' => false,'message' => 'Category not found.'], 404);
        }

        if ($category->subcategories()->exists()) {
            return response()->json(['success' => false, 'message' => 'Cannot delete this category because it has subcategories.'
            ], 400);
        }

        $category->delete();

        return response()->json(['success' => true,'message' => 'Category deleted successfully.']);
    }

    public function updateStatus(Request $request, Category $category)
    {
        $category->status = $request->status;
        $category->save();

        return response()->json(['success' => true ,'message' => 'Category status change successfully.']);
    }
}
