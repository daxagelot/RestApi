<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productattribute extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function get_attr(){
        return $this->belongsTo(Attribute::class,'attribute_id');
    }
    public function get_attr_value(){
        return $this->belongsTo(AttributeValue::class,'attribute_value_id');
    }
}
