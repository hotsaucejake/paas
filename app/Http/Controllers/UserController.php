<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_users')->only(['index', 'show']);
        $this->middleware('permission:add_users')->only(['create', 'store']);
        $this->middleware('permission:edit_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only('delete');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->get();

        return view('monster.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('monster.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedUser = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedUser['name'],
            'email' => $validatedUser['email'],
            'password' => Hash::make($validatedUser['password']),
        ]);

        if(isset($request->roles))
        {
            $user->assignRole($request->roles);
        } else {
            $user->assignRole('active'); // assign a default role to new users
        }

        return redirect()->route('user.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'New user created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('monster.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedUser = $request->validate([
            'name' => 'required',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $validatedUser['name'];

        if($validatedUser['password'])
        {
            $user->password = Hash::make($validatedUser['password']);
        }

        $updated = $user->save();

        if(isset($request->roles))
        {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles('default');
        }

        if($updated)
        {
            return redirect()->route('user.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'Updated the user.');
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
    public function destroy(User $user)
    {
        $deleted = $user->delete();

        if($deleted)
        {
            return redirect()->route('user.index')
                ->with('toastr', 'success')
                ->with('title', 'Success!')
                ->with('message', 'User deleted.');
        } else {
            return redirect()->route('user.index')
                ->with('toastr', 'error')
                ->with('title', 'Error!')
                ->with('message', 'Hmmm... there was some type of error with this.');
        }
    }
}
