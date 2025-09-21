<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Expense;
use App\Models\ExpensesItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['expenses'] = Expense::select('expenses.*','expenses_items.item','branches.branch','warehouses.name')
                ->join('expenses_items','expenses_items.id','expenses.expense_item_id')
                ->leftJoin('branches','branches.id','expenses.branch_id')
                ->leftJoin('warehouses','warehouses.id','expenses.warehouse_id')
                ->orderBy('expenses.created_at','DESC')->get();

        $data['items'] = ExpensesItem::orderBy('item')->get();
        $data['branches'] = Branch::orderBy('branch')->get();
        $data['warehouses'] = Warehouse::all();

        return view('others.expenses',$data);
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
        $expense = new Expense();
        $expense->expense_item_id = $request->expense_item_id;
        $expense->price = $request->price;
        $expense->description = $request->description;
        $expense->branch_id = $request->branch_id;
        $expense->warehouse_id = $request->warehouse_id;
        $expense->save();

        return back()->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $Expense)
    {
               echo "am here in show";

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $Expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $expense_id)
    {
        
        $expense =  Expense::find($expense_id);
        $expense->expense_item_id = $request->expense_item_id;
        $expense->price = $request->price;
        $expense->description = $request->description;
        $expense->branch_id = $request->branch_id;
        $expense->warehouse_id = $request->warehouse_id;
        $expense->update();

        return back()->with("success_message","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $expense_id)
    {
        Expense::where('id', $expense_id)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }
}
