<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Live;
use Illuminate\Http\Request;

class LiveController extends Controller
{
    public function index()
    {
        $lives = Live::get();
        return view('auth.lives.index', compact('lives'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Live $life)
    {
        return view('auth.lives.form', compact('life'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Live $life)
    {
        $params = $request->all();
        $life->update($params);
        session()->flash('success', 'Прямой эфир обновлен');
        return redirect()->route('lives.index');
    }

    public function destroy(Live $life)
    {
        $life->delete();
        session()->flash('success', 'Заявка ' . $life->message . ' удалена');
        return redirect()->route('lives.index');
    }


}