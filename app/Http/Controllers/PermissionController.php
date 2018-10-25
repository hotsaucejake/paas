<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_permissions')->only(['index', 'show']);
        $this->middleware('permission:add_permissions')->only(['create', 'store']);
        $this->middleware('permission:edit_permissions')->only(['edit', 'update']);
        $this->middleware('permission:delete_permissions')->only('delete');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::with('roles')->get();

        return view('monster.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('monster.permission.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedPermission = $request->validate([
            'name' => 'required|alpha_dash',
            'guard_name' => 'nullable|alpha_dash',
        ]);

        $permission = Permission::create($validatedPermission);

        if(isset($request->roles))
        {
            $permission->syncRoles($request->roles);
        }

        return redirect()->route('permission.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'New permission created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();

        return view('monster.permission.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validatedPermission = $request->validate([
            'name' => 'required|alpha_dash',
        ]);

        $permission->name = $validatedPermission['name'];

        $updated = $permission->save();

        $permission->syncRoles($request->roles);  // if null it will remove all roles

        if($updated)
        {
            return redirect()->route('permission.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Updated the permission.');
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
    public function destroy(Permission $permission)
    {
        $deleted = $permission->delete();

        if($deleted)
        {
            return redirect()->route('permission.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Permission deleted.');
        } else {
            return redirect()->route('permission.index')
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }
}
