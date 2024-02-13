<?php

namespace App\Models;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productimage extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function Product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
