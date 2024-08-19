<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "slug",
        "is_approved",
        "category_id",
        "sub_category_id",
        "sub_category_id",
        "user_id",
        "description",
        "photo",
        "status",
        "admin_comment",
    ];

    public function tag(){

        return $this->belongsToMany(Tag::class);
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }
    public function subCategory(){

        return $this->belongsTo(SubCategory::class);
    }
    public function user(){

        return $this->belongsTo(User::class);
    }
    public function comment(){

        return $this->hasMany(Comment::class)->whereNull('comment_id');
    }

    public function post_read_count(){
       return $this->hasOne(PostCount::class, 'post_id');
    }
}
