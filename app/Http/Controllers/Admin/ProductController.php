<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['datas'] = Product::select('products.*', 'users.name as created_by')
        ->where('products.deleted_at', null)
        ->leftJoin('users', 'users.id', '=', 'products.created_by')
        ->orderBy('id', 'desc')
        ->paginate(20);
        $data['title'] = "Product List";
        return view('admin.product.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Add New Product";
        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $product = new Product();
        $product->title = $title;
        $product->created_by = Auth::user()->id;
        
        $product->save();
        $slug = Str::slug($title, "-");
        $checkSlug = Product::where('slug', $slug)->count();
        if (empty($checkSlug)) {
            $product->slug = $slug;
            $product->save();
        }else{
            $new_slug = $slug . '-' . $product->id;
            $product->slug = $new_slug;
            $product->save();
        }
       
        return redirect('admin/product/'. $product->id . '/edit')->with('success', 'Product Created Successfully');
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
        $product = Product::find($id);
        if(!empty($product)) {
            $data['brand'] = Brand::where('status', 0)->where('deleted_at', null)->orderBy('name', 'asc')->get();
            $data['color'] = Color::where('status', 0)->where('deleted_at', null)->orderBy('name', 'asc')->get();
            $data['categories'] = Category::select('categories.*')
                                    ->leftJoin('users', 'users.id', '=', 'categories.created_by')
                                    ->where('categories.deleted_at', null)
                                    ->where('categories.status', 0)
                                    ->orderBy('categories.name', 'asc')
                                    ->get();
            $data['subcategories'] = SubCategory::where('category_id', $product->category_id)->where('deleted_at', null)->get();
            $data['data'] = $product;
            $data['title'] = "Edit Product";
            return view('admin.product.edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request->all());
        $product = Product::find($id);
        if(!empty($product)) {
            $product->title = $request->title;
            $product->sku = $request->sku;
            $product->sub_category_id = $request->sub_category_id;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            $product->old_price = $request->old_price;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->additional_information = $request->additional_information;
            $product->shipping_returns = $request->shipping_returns;
            $product->status = $request->status;
            $product->save();
            ProductColor::where('product_id', $product->id)->delete();
            if(!empty($request->color_id)) {
                foreach ($request->color_id as $key => $value) {
                    $productColor = new ProductColor();
                    $productColor->product_id = $product->id;
                    $productColor->color_id = $value;
                    $productColor->save();
                }
            }

            ProductSize::where('product_id', $product->id)->delete();

            if(!empty($request->size)) {
                foreach ($request->size as $size) {
                    if(!empty($size['name'])) {  
                        $saveSize = new ProductSize();
                        $saveSize->product_id = $product->id; 
                        $saveSize->name = $size['name'];
                        $saveSize->price = !empty($size['price']) ? $size['price'] : 0;
                        $saveSize->save(); 
                    }
                }
            }

            return redirect('admin/product/'. $product->id . '/edit')->with('success', 'Product Updated Successfully');
        }else{
            abort(404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
