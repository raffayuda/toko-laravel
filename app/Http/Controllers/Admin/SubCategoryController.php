<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Sub Category List";
        $data['datas'] = SubCategory::select('sub_categories.*', 'categories.name as category_name', 'users.name as created_by')
                                    ->where('sub_categories.deleted_at', null)
                                    ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                                    ->leftjoin('users', 'users.id', '=', 'sub_categories.created_by')
                                    ->paginate(20);
        return view('admin.subcategory.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::select('categories.*', 'users.name as created_by')
                                        ->leftJoin('users', 'users.id', '=', 'categories.created_by')
                                        ->get();
        $data['title'] = "Add New Sub Category";
        return view('admin.subcategory.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subcategory = new SubCategory();
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description); 
        $subcategory->meta_keywords = trim($request->meta_keywords); 
        $subcategory->created_by = Auth::user()->id; 
        $subcategory->save();
        return redirect('admin/subcategory')->with('success', 'Sub Category Created Successfully');
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
        $data['title'] = "Edit Sub Category";
        $data['data'] = SubCategory::find($id);
        $data['categories'] = Category::select('categories.*', 'users.name as created_by')
                                        ->leftJoin('users', 'users.id', '=', 'categories.created_by')
                                        ->get();
        return view('admin.subcategory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description); 
        $subcategory->meta_keywords = trim($request->meta_keywords); 
        $subcategory->save();
        return redirect('admin/subcategory')->with('success', 'Sub Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        return redirect('admin/subcategory')->with('success', 'Sub Category Deleted Successfully');
    }




    public function get_sub_category(Request $request)
    {
        $category_id = $request->id;
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        $html = '';
        $html .= '<option value="">Select</option>';
        foreach ($subcategories as $subcategory) {
            $html .= '<option value="'.$subcategory->id.'">'.$subcategory->name.'</option>';
        }
        $json['html'] = $html;
        echo json_encode($json);
        
    }
}
