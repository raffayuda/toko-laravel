<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Brand List";
        $data['datas'] = Brand::select('brands.*', 'users.name as created_by')
            ->leftJoin('users', 'users.id', '=', 'brands.created_by')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.brand.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Add New Brand";
        return view('admin.brand.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:brands,slug',
         ]);
         $brand = new Brand();
         $brand->name = trim($request->name);
         $brand->slug = trim($request->slug);
         $brand->status = trim($request->status);
         $brand->meta_title = trim($request->meta_title);
         $brand->meta_description = trim($request->meta_description); 
         $brand->meta_keywords = trim($request->meta_keywords); 
         $brand->created_by = Auth::user()->id; 
         $brand->save();
         return redirect('/admin/brand')->with('success', 'Brand Created Successfully');
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
        $data['title'] = "Edit Brand";
        $data['data'] = Brand::find($id);
        return view('admin.brand.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'slug' => 'required|unique:brands,slug,'.$id,
         ]);
        $brand = Brand::find($id);
        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description); 
        $brand->meta_keywords = trim($request->meta_keywords); 
        $brand->save();
        return redirect('/admin/brand')->with('success', 'Brand Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect('/admin/brand')->with('success', 'Brand Deleted Successfully');
    }
}
