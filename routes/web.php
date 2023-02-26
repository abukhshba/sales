<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['prefix'=>"admin/user"],function(){

    Route::get("/",[UserController::class,"index"]);
    Route::get("/create",[UserController::class,"create"]);
    Route::post("/store",[UserController::class,"store"]);
    Route::get("/delete/{id}",[UserController::class,"destroy"]);


});
//"middleware"=>"auth"
Route::group(['prefix'=>"admin/product"],function(){

    Route::get("/",[ProductController::class,"index"]);
    Route::get("/create",[ProductController::class,"create"]);
    Route::post("/store",[ProductController::class,"store"]);
    Route::get("/delete/{id}",[ProductController::class,"destroy"]);


});
Route::group(['prefix'=>"admin/bill"],function(){

    Route::get("/",[BillController::class,"index"]);
    Route::get("/create",[BillController::class,"create"]);
    Route::post("/store",[BillController::class,"store"]);
    Route::get("/delete/{id}",[BillController::class,"destroy"]);
    Route::get("/showCategory/{product_id}",[RelationsController::class,"getProductBill"])->name('product.bill');
    Route::post("saveProductBill",[RelationsController::class,"saveProductBill"])->name('save.product.bill');


});


/*******************/
/**** for debug ****/
/*******************/

function showBills($BillId){
    echo "<pre>";
    $rows = \App\Models\Bill::join('users' , 'users.id' ,'=','bills.user_id')->
        join('bill_details' , 'bill_details.bill_id' , '=' , 'bills.id')->
        join('products', 'products.id' , '=' ,'bill_details.product_id')->
        select('users.name as user_name' , 'bill_details.*' , 'bills.id as bill_id' , 'products.name as product_name' , 'products.price')->
        where('bills.id' , $BillId)->get(); 

    $OverAllPrice= 0 ; 
    echo "<table>";
    foreach($rows as $row ){
        $OverAllPrice += $row->total; 
        echo "<tr>".
            "<td>".$row->bill_id."</td>".
            "<td>".$row->user_name."</td>".
            "<td>".$row->product_name."</td>".
            "<td>".$row->quantity."</td>".
            "<td>".$row->price."</td>".
            "<td>".$row->total."</td>".
        "</tr>";
    }
    echo "</table>"; 
    echo "<h3>Over All Price = ".  $OverAllPrice ."</h3><hr>"; 
    $OverAllPrice=0; 

};


//logic
route::get('/dd', function (){
    //selected products 
    $products = \App\Models\Product::select('id', 'price')->get();
    
    $user= \App\Models\User::get(); 
    
    $quantity=[2,3,1,1]; 
    
    //create bill for customer
    $bill = new \App\Models\Bill; 
    $bill->user_id = $user[0]->id;
    $bill->save();  

    //build bill_details first 
    foreach($products as $index=>$product){
        \App\Models\BillDetails::create([
            'bill_id'=> $bill->id, 
            'product_id' => $product->id,
            'quantity' => $quantity[$index],
            'product_price' => $product->price,
            'total' => $product->price * $quantity[$index]
        ]); 
    }

    foreach (\App\Models\Bill::orderBy('id' , 'desc')->get() as $bill){
        showBills($bill->id); 
    } ;
});



// Route::get("admin/bill/store",function (){
//     $x = json_decode($_REQUEST['billDetails']); 
//     if ($x[0]->quantity ==null) {
//     echo 'Error';
//     }else {
//     echo 'ok'; 
//     }
// });
