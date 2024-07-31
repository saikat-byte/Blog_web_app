<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

   protected $fillable = [
        'category_name',
        'slug_name',
        'order_by',
        'status',
   ];

   public function sub_categories(){

    return $this->hasMany(SubCategory::class);
   }
}
