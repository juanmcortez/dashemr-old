<?php

namespace App\Http\Controllers\Invoices;

use App\Models\Invoices\Encounter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Invoices\StoreEncounterRequest;
use App\Http\Requests\Invoices\UpdateEncounterRequest;

class EncounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Invoices\StoreEncounterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEncounterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices\Encounter  $encounter
     * @return \Illuminate\Http\Response
     */
    public function show(Encounter $encounter)
    {
        return view('encounters.show', compact('encounter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices\Encounter  $encounter
     * @return \Illuminate\Http\Response
     */
    public function edit(Encounter $encounter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Invoices\UpdateEncounterRequest  $request
     * @param  \App\Models\Invoices\Encounter  $encounter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEncounterRequest $request, Encounter $encounter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices\Encounter  $encounter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Encounter $encounter)
    {
        //
    }
}
