<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['items'] = Item::select('items.*','units.unit','categories.category')
            ->join('units','units.id','items.unit_id')
            ->join('categories','categories.id','items.category_id')
            ->get();

        return view('items.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['units'] = Unit::orderBy('unit')->get();
        $data['categories'] = Category::orderBy('category')->get();

        return view('items.create',$data);
 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->unit_id = $request->unit_id;
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->barcode = $request->barcode;
        $item->description = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image'); // use 'image', not 'images'
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('itemImages'), $name);

            $item->image = $name;
        }
        $item->save();

        return redirect(route('items.index'))->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $item_id)
    {
        $data['item'] = Item::findOrFail($item_id);
        $data['units'] = Unit::orderBy('unit')->get();
        $data['categories'] = Category::orderBy('category')->get();

        return view('items.edit',$data);
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $item_id)
    {
        $item = Item::find($item_id);
        $item->name = $request->name;
        $item->unit_id = $request->unit_id;
        $item->category_id = $request->category_id;
        $item->price = $request->price;
        $item->barcode = $request->barcode;
        $item->description = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image'); // use 'image', not 'images'
            $name = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('itemImages'), $name);

            $item->image = $name;
        }
        $item->update();

        return redirect(route('items.index'))->with("success_message","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $item_id)
    {
        Item::where('id', $item_id)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }

    public function itemBarcode()
    {
        do {
            // Generate random 12-digit number
            $serial = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (DB::table('items')->where('barcode', $serial)->exists());

        return response()->json([
            'code' => $serial,
        ]);
    }





}
