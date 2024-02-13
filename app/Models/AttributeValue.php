<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "attribute_values";
    protected $guarded = [];

    public function attribute(){
        return $this->hasOne(Attribute::class,'id','attribute_id');
    }
}
