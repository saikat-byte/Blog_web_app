<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // User can see only their post section
        $query =  Post::with('category', 'subCategory', 'tag', 'user')->latest();
        if (Auth::user()->role === User::USER) {
            $posts = $query->where('user_id', Auth::id())->paginate(20);
        }else{
            $posts = $query->paginate(20);

        }

        return \view('backend.modules.post.index', \compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::pluck('category_name', 'id');
        $tags = Tag::where('status', 1)->select('tag_name', 'id')->get();
        return \view('backend.modules.post.create', \compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {

        $post_data = $request->except(['slug', 'photo', 'tag_name_ids']);
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;
            $thumb_height = 150;
            $thumb_with = 150;
            $path = 'image/post/original';
            $thumb_path = 'image/post/thumbnail';
            $photoUpload = new PhotoUploadController();
            $post_data['photo'] = $photoUpload->imageUpload($name, $height, $width, $path, $file);
            $photoUpload->imageUpload($name, $thumb_height, $thumb_with,  $thumb_path, $file);
        }

        $post = Post::create($post_data);

        $post->tag()->attach($request->input('tag_name_ids'));

        return \redirect()->back()->with('success', 'Post created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ( Auth::user()->role == User::USER && $post->user_id !== Auth::id()) {
             \abort(403, 'Unauthorized');
        }else{
            $post->load(['tag', 'category', 'subCategory', 'user']);
        }

        return view('backend.modules.post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {


        $categories = Category::pluck('category_name', 'id');
        $tags = Tag::where('status', 1)->select('tag_name', 'id')->get();
        $subCategories = SubCategory::where('category_id', $post->category_id)->pluck('sub_category_name', 'id');
        return \view('backend.modules.post.edit', \compact('post', 'categories', 'tags', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post_data = $request->except(['slug', 'photo', 'tag_name_ids']);
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_data['is_approved'] = 1;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;
            $thumb_height = 150;
            $thumb_with = 150;
            $path = 'image/post/original';
            $thumb_path = 'image/post/thumbnail';

            // Delete old photo if exists
            if ($post->photo) {
                $oldPath = public_path($post->photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
                // Also delete the thumbnail if it exists
                $old_thumb_path = public_path($thumb_path . '/' . basename($post->photo));
                if (file_exists($old_thumb_path)) {
                    unlink($old_thumb_path);
                }
            }

            $photoUpload = new PhotoUploadController();
            $post_data['photo'] = $photoUpload->imageUpload($name, $height, $width, $path, $file);
            $photoUpload->imageUpload($name, $thumb_height, $thumb_with,  $thumb_path, $file);
        }

        $post->update($post_data);

        $post->tag()->sync($request->input('tag_name_ids'));

        return \redirect()->back()->with('success', 'Post updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        // delete associated tags
        $post->tag()->detach();

        // delete associated photo and thumbnail
        if ($post->photo) {
            $path = public_path('image/post/original/' . $post->photo);
            if (file_exists($path)) {
                unlink($path);
            }
            $thumb_path = public_path('image/post/thumbnail/' . $post->photo);
            if (file_exists($thumb_path)) {
                unlink($thumb_path);
            }
        }

        $post->delete();
        return Redirect()->back()->with('success', 'Post deletecd successfully');
    }

}
