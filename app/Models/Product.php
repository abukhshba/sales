<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',

    ];
    public function bills()
    {
        return $this->belongsToMany(Bill::class , table:'product_bills'
        ,foreignPivotKey:'product_id' ,relatedPivotKey:'bill_id',
        parentKey:'id' , relatedKey:'id'  )->withTimestamps();

    }




    use HasFactory;
}
