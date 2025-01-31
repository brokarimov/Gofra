<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        $roles = Role::all();
        return view('pages.User.user-index', ['models' => $users, 'roles' => $roles]);
    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return back();
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();


        $data['password'] = bcrypt($data['password']);


        $user->update($data);

        return back()->with('success', 'User updated successfully!');
    }


    public function delete(User $user)
    {
        $user->delete();
        return back();
    }
    public function status(User $user)
    {
        if ($user->status == 1) {
            $user->status = 0;
            $user->save();
        } elseif ($user->status == 0) {
            $user->status = 1;
            $user->save();
        }
        return back();
    }
}
