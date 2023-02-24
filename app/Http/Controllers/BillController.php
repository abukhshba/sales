<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Product;
use App\Models\Product_bill;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::all();
        $user =  User::all();
        return view('admin.bill.index', [
            'products' => $products,
            'user'=>$user,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $bills =  Bill::all();
        $products =  Product::all();

        $allproducts = Product::select('id' , 'name')->get();
        $users = User::select('id' , 'name')->get();

        return view('admin.bill.create',compact('bills','products','users' , 'allproducts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $billRecord = new Bill;
        $billRecord->user_id = $request->user_id;

        $billRecord ->quantity = $request->quantity;

        $billRecord->save();

        foreach ($request->bill_id as $product){
            $billRecord->overall_price .= $request->quantity * Product::find('price');
            Product_bill::insert([
                'bill_id' =>$billRecord->id,
                'product_id'=>$product,

            ]);
        }
        dd($billRecord->overall_price);

        return redirect("admin/bill");
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
}