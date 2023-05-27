<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $role = Role::create($request->all());
        return redirect()
            ->route('admin.role.index')
            ->with('success', 'New role successfully created');
    }

    public function show(Role $role)
    {
        return view('admin.role.show', compact('role'));
    }

    public function edit($id)
    {
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $id = $role->id;

        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $role->update($request->all());

        return redirect()
            ->route('admin.role.index')
            ->with('success', 'The role was successfully edited');
    }

    public function destroy($id)
    {
        $role->delete();
        return redirect()
            ->route('admin.role.index')
            ->with('success', 'The role is successfully deleted');
    }
}
