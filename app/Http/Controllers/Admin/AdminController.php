<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = User::where('is_admin', 1)
            ->orderBy('id', 'desc')
            ->get();
        $data['title'] = "Admin List";
        return view('admin.admin.list', compact('datas'), $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Create Admin";
        return view('admin.admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = 1;
        $user->status = $request->status;
        $user->save();
        return redirect('/admin/admin/list')->with('success', 'Admin Created Successfully');
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
        $data['title'] = "Edit Admin";
        $data['data'] = User::find($id);
        return view('admin.admin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = 1;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->save();
        return redirect('/admin/admin/list')->with('success', 'Admin Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/admin/list')->with('success', 'Admin Deleted Successfully');
    }
}
