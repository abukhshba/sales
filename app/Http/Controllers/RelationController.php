<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Bill;
use App\Models\Product_bill;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    //
    public function getProductBill($bill_id)
    {
        $products = Product_bill::join('products', 'products.id', '=', 'product_bills.product_id')->
            where('product_bills.bill_id', $bill_id)->
            select('product.name')->get();
        // dd($categories);
        return view('admin.bill.index', compact('products'));

    }
    public function saveProductBill(Request $request)
    {
        return $request;
    }


}
