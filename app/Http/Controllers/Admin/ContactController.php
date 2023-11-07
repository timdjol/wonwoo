<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Currency;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::get();
        $dollar = Currency::query()->where('id', 2)->get();
        return view('auth.contacts.index', compact('contacts', 'dollar'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $dollar = Currency::query()->where('id', 2)->get();
        return view('auth.contacts.form', compact('contact', 'dollar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $params = $request->all();

        //dd($params);
        //dd($params['rate']);
        Currency::query()->where('id', 2)->update(['rate' => $params['rate']]);
        $contact->update($params);
        session()->flash('success', 'Контакты обновлены');
        return redirect()->route('contacts.index');
    }

}
