<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::paginate(20);
        return view('auth.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::get();
        return view('auth.regions.form', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();
        Region::create($params);
        session()->flash('success', 'Регион добавлен ' . $request->title);
        return redirect()->route('regions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        return view('auth.regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        $countries = Country::get();
        return view('auth.regions.form', compact('region', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {
        $params = $request->all();
        $region->update($params);
        session()->flash('success', 'Регион ' . $request->title . ' обновлен');
        return redirect()->route('regions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        $region->delete();
        session()->flash('success', 'Регион ' . $region->title . ' удален');
        return redirect()->route('regions.index');
    }
}
