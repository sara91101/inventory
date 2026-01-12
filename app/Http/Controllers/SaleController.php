<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::orderByDesc('id')->get();

        return view('sales.index',['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();

        return view('sales.create',[
            'customers' => $customers,
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale = new Sale();
        $sale->sale_date = $request->sale_date;
        $sale->customer_id  = $request->customer_id ;
        $sale->full_amount = $request->full_amount;
        $sale->notes = $request->notes;
        $sale->save();

        $items = $request->items;
        $quantities = $request->quantities;
        $unit_prices = $request->unit_prices;
        $full_prices = $request->full_prices;

        foreach($items as $i => $item){
            $sale_item = new SaleItem();
            $sale_item->sale_id = $sale->id;
            $sale_item->item_id = $item;
            $sale_item->quantity = $quantities[$i];
            $sale_item->unit_price = $unit_prices[$i];
            $sale_item->full_price = $full_prices[$i];
            $sale_item->save();
        }

        return redirect(route('sales.index'))->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show( $sale_id)
    {
        $sale = Sale::with(['customers', 'items.items'])->find($sale_id);

        return response()->json($sale);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sale = Sale::with(['customers', 'items.items'])->findOrFail($id);
        $customers = Customer::all();
        $items = Item::all();

        return view('sales.edit', compact('sale', 'customers', 'items'));
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $sale = Sale::findOrFail($id);

            // 1️⃣ Update sale main info
            $sale->update([
                'sale_date'   => $request->sale_date,
                'customer_id' => $request->customer_id,
                'full_amount' => $request->full_amount,
                'notes'       => $request->notes,
            ]);

            // 2️⃣ Delete removed items
            $sale->items()->delete();

            // 3️⃣ Re-insert items cleanly
            foreach ($request->items as $index => $item_id) {
                $sale->items()->create([
                    'item_id'    => $item_id,
                    'unit_price' => $request->unit_prices[$index],
                    'quantity'   => $request->quantities[$index],
                    'full_price' => $request->full_prices[$index],
                ]);
            }
        });

        return redirect()
            ->route('sales.index')
            ->with('success_message', 'تم تحديث الفاتورة بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $sale)
    {
        Sale::where('id', $sale)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }
}
