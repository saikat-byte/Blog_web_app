<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('order_by')->get();

       return \view('backend.modules.tag.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [

            'tag_name' => 'required|min:3|max:255',
            'slug_name' => 'required|min:3|max:255|unique:tags',
            'order_by' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tag_data = $request->all();
        $tag_data['slug_name'] = Str::slug($request->input('slug_name'));
        // Store validated data
        Tag::create( $tag_data);

        return Redirect()->back()->with('success', 'Tag created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('backend.modules.tag.show', ['tag' => $tag]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('backend.modules.tag.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $validator =  Validator::make($request->all(), [

            'tag_name' => 'required|min:3|max:255',
            'slug_name' => 'required|min:3|max:255|unique:tags,slug_name,' . $tag->id,
            'order_by' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tag_data = $request->all();
        $tag_data['slug_name'] = Str::slug($request->input('slug_name'));
        // Store validated data
        $tag->update( $tag_data);

        return Redirect()->back()->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return Redirect()->back()->with('success', 'Tag deletecd successfully');
    }
}
