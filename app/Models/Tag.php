<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_name',
        'slug_name',
        'order_by',
        'status',
   ];



   public function post(){

    return $this->belongsToMany(Post::class);
}
}
