<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('category')->get();

        return view('settings.categories',compact('categories'));
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
        $category = new Category();
        $category->category = $request->category;
        $category->save();

        return back()->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $Category)
    {
               echo "am here in show";

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $Category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $category_id)
    {
        
        $category =  Category::find($category_id);
        $category->category = $request->category;
        $category->update();

        return back()->with("success_message","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $category_id)
    {
        Category::where('id', $category_id)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }
}
