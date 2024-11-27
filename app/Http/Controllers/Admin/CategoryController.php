<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Category::select('categories.*', 'users.name as created_by')
            ->leftJoin('users', 'users.id', '=', 'categories.created_by')
            ->orderBy('id', 'desc')
            ->get();
        $data['title'] = "Category List";
        return view('admin.category.list', compact('datas'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Add New Category";
        return view('admin.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
           'slug' => 'required|unique:categories,slug',
        ]);
        $category = new Category();
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description); 
        $category->meta_keywords = trim($request->meta_keywords); 
        $category->created_by = Auth::user()->id; 
        $category->save();
        return redirect('/admin/category')->with('success', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = "Edit Category";
        $data['data'] = Category::find($id);
        return view('admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
           'slug' => 'required|unique:categories,slug,'.$id,
        ]);
        $category = Category::find($id);
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description); 
        $category->meta_keywords = trim($request->meta_keywords); 
        $category->save();
        return redirect('/admin/category')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/admin/category')->with('success', 'Category Deleted Successfully');
    }
}
