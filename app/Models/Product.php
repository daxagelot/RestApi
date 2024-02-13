<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function ProductCategory(){
        return $this->belongsTo(Category::class,'categories_id');
    }
    public function Productimage(){
        return $this->hasMany(Productimage::class,'product_id');
    }
    public function Productattributes(){
        return $this->hasMany(Productattribute::class,'product_id');
    }
}
