<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_roles')->only(['index', 'show']);
        $this->middleware('permission:add_roles')->only(['create', 'store']);
        $this->middleware('permission:edit_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only('delete');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('monster.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('monster.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRole = $request->validate([
            'name' => 'required|alpha_dash',
            'guard_name' => 'nullable|alpha_dash',
        ]);

        $role = Role::create($validatedRole);

        if(isset($request->permissions))
        {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('role.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'New role created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('monster.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validatedRole = $request->validate([
            'name' => 'required|alpha_dash',
        ]);

        $role->name = $validatedRole['name'];
        
        $updated = $role->save();

        $role->syncPermissions($request->permissions); // if null it will remove all permissions

        if($updated)
        {
            return redirect()->route('role.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Updated the role.');
        } else {
            return back()
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $deleted = $role->delete();

        if($deleted)
        {
            return redirect()->route('role.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Role deleted.');
        } else {
            return redirect()->route('role.index')
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }
}
