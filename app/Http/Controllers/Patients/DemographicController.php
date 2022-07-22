<?php

namespace App\Http\Controllers\Patients;

use App\Http\Controllers\Controller;
use App\Models\Patients\Demographic;
use App\Http\Requests\Patients\StoreDemographicRequest;
use App\Http\Requests\Patients\UpdateDemographicRequest;

class DemographicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Demographic::orderBy('lastName')
            ->orderBy('firstName')
            ->orderBy('middleName')
            ->paginate(15);
        return view('patients.index', compact('patients'));
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
     * @param  \App\Http\Requests\Patients\StoreDemographicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDemographicRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patients\Demographic  $demographic
     * @return \Illuminate\Http\Response
     */
    public function show(Demographic $demographic)
    {
        return view('patients.show', compact('demographic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patients\Demographic  $demographic
     * @return \Illuminate\Http\Response
     */
    public function edit(Demographic $demographic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Patients\UpdateDemographicRequest  $request
     * @param  \App\Models\Patients\Demographic  $demographic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDemographicRequest $request, Demographic $demographic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patients\Demographic  $demographic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demographic $demographic)
    {
        //
    }
}
