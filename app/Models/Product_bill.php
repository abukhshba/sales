<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_bill extends Model
{

    public $timestamps = true;
    protected $fillable = [
        'bill_id',
        'product_id'
    ];


    use HasFactory;
}