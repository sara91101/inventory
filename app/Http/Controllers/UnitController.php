<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::orderBy('unit')->get();

        return view('settings.units',compact('units'));
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
        $unit = new Unit();
        $unit->unit = $request->unit;
        $unit->save();

        return back()->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
               echo "am here in show";

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $unit_id)
    {
        
        $unit =  Unit::find($unit_id);
        $unit->unit = $request->unit;
        $unit->update();

        return back()->with("success_message","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $unit_id)
    {
        Unit::where('id', $unit_id)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }
}
