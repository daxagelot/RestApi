<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='galleries';

    protected $guarded = [];

protected $fillable = ['name', 'image', 'category_id', 'created_by'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
