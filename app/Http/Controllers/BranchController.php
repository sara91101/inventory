<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::orderBy('branch')->get();

        return view('settings.branches',compact('branches'));
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
        $branch = new Branch();
        $branch->branch = $request->branch;
        $branch->save();

        return back()->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $Branch)
    {
               echo "am here in show";

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $Branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $branch_id)
    {
        
        $branch =  Branch::find($branch_id);
        $branch->branch = $request->branch;
        $branch->update();

        return back()->with("success_message","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $branch_id)
    {
        Branch::where('id', $branch_id)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }
}
