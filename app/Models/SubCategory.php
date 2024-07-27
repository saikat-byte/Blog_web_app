<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category_name',
        'slug_name',
        'category_id',
        'order_by',
        'status',
   ];

   public function category(){

    return $this->belongsTo(Category::class);
   }
}
