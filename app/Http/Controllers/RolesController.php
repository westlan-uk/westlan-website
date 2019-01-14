<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check-permission:site_admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index', [
            'roles' => Role::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30|unique:roles',
        ]);

        Role::create([
            'name' => $request->input('name'),
        ]);

        return redirect('/roles')->with('status', 'New Role successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:30|unique:roles,name,' . $role->id,
            'site_admin' => 'nullable|integer',
            'gallery_admin' => 'nullable|integer',
        ]);

        $role->name = $request->input('name');
        $role->site_admin = $request->input('site_admin') ?? 0;
        $role->gallery_admin = $request->input('gallery_admin') ?? 0;

        $role->save();

        return redirect('/roles/' . $role->id)->with('status', 'Successfully Updated Role.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
