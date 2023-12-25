<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\Country;
use App\Models\User;

class UserController
{
    public function index()
    {
        $users = User::get();
        return view('auth.users.index', compact('users'));
    }

    public function create()
    {
        $users = User::get();
        return view('auth.users.form', compact('users'));
    }

    public function store(UserRequest $request)
    {
        $params = $request->all();
        User::create($params);
        session()->flash('success', 'Пользователь ' . $request->code . ' добавлен');
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('auth.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $countries = Country::get();
        return view('auth.users.form', compact('user', 'countries'));
    }

    public function update(UserRequest $request, User $user)
    {
        $params = $request->all();
        $user->update($params);
        session()->flash('success', 'Пользователь ' . $user->name . ' обновлен');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'Пользователь ' . $user->name . ' удален');
        return redirect()->route('users.index');
    }
}