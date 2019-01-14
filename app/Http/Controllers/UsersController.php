<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->role->site_admin) {
            abort(403);
        }

        $users = User::orderBy('username')->paginate(50);

        return view('users.index', ['users' => $users]);
    }

    public function search()
    {
        if (!Auth::user()->role->site_admin) {
            abort(403);
        }

        $q = Input::get('q');

        $users = User::where('username', 'LIKE', '%' . $q . '%')
            ->orWhere('email', 'LIKE', '%' . $q . '%')
            ->orWhere('name', 'LIKE', '%' . $q . '%')
            ->orderBy('username')
            ->paginate(50);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Auth::user()->role->site_admin && Auth::user()->id !== $user->id) {
            abort(403);
        }

        $roles = Role::get();

        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!Auth::user()->role->site_admin && Auth::user()->id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'display_pic' => 'image|max:1000',
            'username' => 'required|string|max:40|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:191|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'mailing_list' => 'boolean',
            'role' => 'integer',
        ]);

        /* Update Display Pic */
        $dp = $request->file('display_pic');

        if ($dp !== null) {
            // Resize to 150x150
            $resize = Image::make($dp->path())->fit(150, 150)->encode('jpg');

            // Generate hash name
            $hash = md5($resize->__toString());
            $path = "img/displayPics/{$hash}.jpg";

            // Save to public folder
            $resize->save(public_path($path));
            $url = "/" . $path;

            $user->display_pic = $url;
        }

        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mailing_list = $request->input('mailing_list') ?? false;

        /* Save password if changed */
        $password = $request->input('password') ?? null;

        if ($password !== null) {
            $user->password = Hash::make($password);
        }

        // Set admin-only editable fields
        if (Auth::user()->role->site_admin) {
            $user->role_id = $request->input('role');
        }

        $user->save();

        return redirect('/users/' . $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!Auth::user()->role->site_admin) {
            abort(403);
        }
        //
    }
}
