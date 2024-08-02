<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){

        $query = Post::with('category', 'tag', 'user', 'subCategory')->where('is_approved', 1)->where('status', 1);
        $posts = $query->latest()->take(5)->get();
        $slider_posts = $query->inRandomOrder()->take(5)->get();
        return view('frontend.modules.index', \compact('posts', 'slider_posts'));
    }
    public function single(){


        $posts = Post::with('category', 'tag', 'user', 'subCategory')
        ->where('is_approved', 1)
        ->where('status', 1)
        ->latest()
        ->firstOrFail();
        $post_title = "Blog Post";
        $sub_title = "Post Details";
        return view('frontend.modules.single-post', \compact('posts', 'post_title', 'sub_title'));
    }

    public function all_post(){

        $posts = Post::with('category', 'tag', 'user', 'subCategory')->where('is_approved', 1)->where('status', 1)->latest()->paginate(9);
        $title = "View all post";
        $sub_title = "Blog post";
        return \view('frontend.modules.blog', \compact('posts', 'title', 'sub_title'));
    }

    public function search(Request $request){

        $posts = Post::with('category', 'tag', 'user', 'subCategory')
        ->where('is_approved', 1)
        ->where('status', 1)
        ->where('title', 'like', '%' . $request->input('search'))
        ->latest()
        ->paginate(3);

        $title = "View Search Result";
        $sub_title = $request->input('search');

        return \view('frontend.modules.blog', \compact('posts', 'title', 'sub_title'));
    }

    public function category($slug){

        $category = Category::where('slug_name', $slug)->firstOrFail();

       if ($category) {
            $posts = Post::with('category', 'tag', 'user', 'subCategory')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(10);
       }


        $title = $category->category_name;
        $sub_title = "Post by category";
        return \view('frontend.modules.blog', \compact('posts', 'title', 'sub_title'));
    }
    public function sub_category($slug, $sub_slug){

        $sub_category = SubCategory::where('slug_name', $sub_slug)->firstOrFail();

       if ($sub_category) {
            $posts = Post::with('category', 'tag', 'user', 'subCategory')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('sub_category_id', $sub_category->id)
            ->latest()
            ->paginate(10);
       }


        $title = $sub_category->sub_category_name;
        $sub_title = "Post by sub category";
        return \view('frontend.modules.blog', \compact('posts', 'title', 'sub_title'));
    }
    // public function tag($slug){

    //     $tag = Tag::where('slug_name', $slug)->firstOrFail();

    //     if ($tag) {
    //          $posts = Post::with('category', 'tag', 'user', 'subCategory')
    //          ->where('is_approved', 1)
    //          ->where('status', 1)
    //          ->where('tag_id', $tag->id)
    //          ->latest()
    //          ->paginate(10);
    //     }


    //      $title = $tag->tag_name;
    //      $sub_title = "Post by tag";
    //      return \view('frontend.modules.blog', \compact('posts', 'title', 'sub_title'));
    // }
}
