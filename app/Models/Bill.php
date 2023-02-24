<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
        protected $fillable = [
            'user_id',
            'overall_price',


        ];
        public function users()
        {
            return $this->hasOne(User::class)->withTimestamps();

        }
        public function products()
        {
            return $this->belongsToMany(Product::class , table:'product_bills'
            ,foreignPivotKey:'bill_id',relatedPivotKey:'product_id',
            parentKey:'id' , relatedKey:'id' )->withTimestamps();

        }
}