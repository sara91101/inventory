<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::orderByDesc('id')->get();

        return view('purchases.index',['purchases' => $purchases]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::all();

        return view('purchases.create',[
            'suppliers' => $suppliers,
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchase = new Purchase();
        $purchase->purchase_date = $request->purchase_date;
        $purchase->supplier_id  = $request->supplier_id ;
        $purchase->full_amount = $request->full_amount;
        $purchase->notes = $request->notes;
        $purchase->save();

        $items = $request->items;
        $quantities = $request->quantities;
        $dollar_unit_prices = $request->dollar_unit_prices;
        $unit_prices = $request->unit_prices;
        $full_prices = $request->full_prices;

        foreach($items as $i => $item){
            $purchase_item = new PurchaseItem();
            $purchase_item->purchase_id = $purchase->id;
            $purchase_item->item_id = $item;
            $purchase_item->quantity = $quantities[$i];
            $purchase_item->dollar_unit_price = $dollar_unit_prices[$i];
            $purchase_item->unit_price = $unit_prices[$i];
            $purchase_item->full_price = $full_prices[$i];
            $purchase_item->save();
        }

        return redirect(route('purchases.index'))->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show( $purchase_id)
    {
        $purchase = Purchase::with(['suppliers', 'items.items'])->find($purchase_id);

        return response()->json($purchase);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $purchase = Purchase::with(['suppliers', 'items.items'])->findOrFail($id);
        $suppliers = Supplier::all();
        $items = Item::all();

        return view('purchases.edit', compact('purchase', 'suppliers', 'items'));
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $purchase = Purchase::findOrFail($id);

            // 1️⃣ Update purchase main info
            $purchase->update([
                'purchase_date'   => $request->purchase_date,
                'customer_id' => $request->customer_id,
                'full_amount' => $request->full_amount,
                'notes'       => $request->notes,
            ]);

            // 2️⃣ Delete removed items
            $purchase->items()->delete();

            // 3️⃣ Re-insert items cleanly
            foreach ($request->items as $index => $item_id) {
                $purchase->items()->create([
                    'item_id'    => $item_id,
                    'unit_price' => $request->unit_prices[$index],
                    'quantity'   => $request->quantities[$index],
                    'full_price' => $request->full_prices[$index],
                ]);
            }
        });

        return redirect()
            ->route('purchases.index')
            ->with('success_message', 'تم تحديث الفاتورة بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $purchase)
    {
        Purchase::where('id', $purchase)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }
}
