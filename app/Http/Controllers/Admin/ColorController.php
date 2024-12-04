<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Color List";
        $data['datas'] = Color::select('colors.*', 'users.name as created_by')
            ->leftJoin('users', 'users.id', '=', 'colors.created_by')
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.color.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Add New Color";
        return view('admin.color.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $color = new Color();
         $color->name = trim($request->name);
         $color->code = trim($request->code);
         $color->status = trim($request->status);
         $color->created_by = Auth::user()->id; 
         $color->save();
         return redirect('/admin/color')->with('success', 'Color Created Successfully');
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
        $data['title'] = "Edit Color";
        $data['data'] = Color::find($id);
        return view('admin.color.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $color = Color::find($id);
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->save();
        return redirect('/admin/color')->with('success', 'Color Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color = Color::find($id);
        $color->delete();
        return redirect('/admin/color')->with('success', 'Color Deleted Successfully');
    }
}
