<?php

namespace App\Http\Controllers;

use App\Models\ExpensesItem;
use Illuminate\Http\Request;

class ExpensesItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ExpensesItem::orderBy('item')->get();

        return view('settings.items',compact('items'));
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
        $item = new ExpensesItem();
        $item->item = $request->item;
        $item->save();

        return back()->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpensesItem $ExpensesItem)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpensesItem $ExpensesItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $item_id)
    {
        
        $item =  ExpensesItem::find($item_id);
        $item->item = $request->item;
        $item->update();

        return back()->with("success_message","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $item_id)
    {
        ExpensesItem::where('id', $item_id)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }
}
