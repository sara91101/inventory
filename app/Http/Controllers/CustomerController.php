<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('name')->get();

        return view('others.customers',compact('customers'));
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
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->save();

        return back()->with("success_message","تمت الاضافة");
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $Customer)
    {
               echo "am here in show";

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $Customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $customer_id)
    {
        
        $customer =  Customer::find($customer_id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->update();

        return back()->with("success_message","تم التعديل");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $customer_id)
    {
        Customer::where('id', $customer_id)->delete();
        return response()->json(['success_message'=> 'تم الحذف']);
    }
}

