<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['warehouses'] = Warehouse::select('warehouses.*','branches.branch')
            ->join('branches','branches.id','warehouses.branch_id')
            ->orderBy('name')->get();

        $data['branches'] = Branch::orderBy('branch')->get();

        return view('settings.warehouses',$data);
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
        $warehouse = new Warehouse();
        $warehouse->name = $request->name;
        $warehouse->branch_id = $request->branch_id;
        $warehouse->address = $request->address;
        $warehouse->save();

        return back()->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $Warehouse)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $Warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $warehouse_id)
    {
        
        $warehouse = Warehouse::find($warehouse_id);
        $warehouse->name = $request->name;
        $warehouse->branch_id = $request->branch_id;
        $warehouse->address = $request->address;
        $warehouse->update();

        return back()->with("success_message","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $warehouse_id)
    {
        Warehouse::where('id', $warehouse_id)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }
}