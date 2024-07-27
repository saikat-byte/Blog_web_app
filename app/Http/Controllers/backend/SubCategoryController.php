<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_categories = SubCategory::with('category')->orderBy('order_by')->get();

       return \view('backend.modules.sub_category.index', ['sub_categories' => $sub_categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('category_name', 'id');

        return view('backend.modules.sub_category.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [

            'sub_category_name' => 'required|min:3|max:255',
            'slug_name' => 'required|min:3|max:255|unique:sub_categories',
            'category_id' => 'required',
            'order_by' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sub_category_data = $request->all();
        $sub_category_data['slug_name'] = Str::slug($request->input('slug_name'));
        // Store validated data
        SubCategory::create( $sub_category_data);

        return Redirect()->back()->with('success', 'Sub category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {

        $subCategory->load('category');
        return view('backend.modules.sub_category.show', ['subCategory' => $subCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::pluck('category_name', 'id');
        return view('backend.modules.sub_category.edit',\compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $validator =  Validator::make($request->all(), [

           'sub_category_name' => 'required|min:3|max:255',
            'slug_name' => 'required|min:3|max:255|unique:sub_categories,slug_name,' . $subCategory->id,
            'category_id' => 'required',
            'order_by' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sub_category_data = $request->all();
        $sub_category_data['slug_name'] = Str::slug($request->input('slug_name'));
        // Store validated data
        $subCategory->update( $sub_category_data);

        return Redirect()->back()->with('success', 'Sub category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return Redirect()->back()->with('success', 'sub category deletecd successfully');
    }

    public function getSubCategoryByCategoryId(int $id){

        $sub_categories = SubCategory::select('id', 'sub_category_name')->where('category_id', $id)->get();

        return \response()->json($sub_categories);
    }
}
