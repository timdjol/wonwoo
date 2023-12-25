<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController
{
    public function index()
    {
        $users = User::get();
        return view('auth.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('auth.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('auth.users.form', compact('user'));
    }

    /**
     * @param UserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $params = $request->all();
        $user->update($params);
        session()->flash('success', 'Пользователь ' . $user->name . ' обновлен');
        return redirect()->route('users.index');
    }
}