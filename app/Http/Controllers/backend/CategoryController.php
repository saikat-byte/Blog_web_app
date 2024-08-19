<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryListResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


       $categories = Category::orderBy('order_by')->get();

       return \view('backend.modules.category.index', ['categories' => $categories]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $validator =  Validator::make($request->all(), [

            'category_name' => 'required|min:3|max:255',
            'slug_name' => 'required|min:3|max:255|unique:categories',
            'order_by' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category_data = $request->all();
        $category_data['slug_name'] = Str::slug($request->input('slug_name'));
        // Store validated data
        Category::create( $category_data);

        return Redirect()->back()->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {



        return view('backend.modules.category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('backend.modules.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $validator =  Validator::make($request->all(), [

            'category_name' => 'required|min:3|max:255',
            'slug_name' => 'required|min:3|max:255|unique:categories,slug_name,' . $category->id,
            'order_by' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category_data = $request->all();
        $category_data['slug_name'] = Str::slug($request->input('slug_name'));
        // Store validated data
        $category->update( $category_data);

        return Redirect()->back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
            $category->delete();
            return Redirect()->back()->with('success', 'Category deletecd successfully');
    }


    // Api create
    public function categoryList(){
        $categories = Category::latest()->get();
        return CategoryListResource::collection($categories);
    }
}
