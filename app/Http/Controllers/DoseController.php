<?php

namespace App\Http\Controllers;

use App\Models\Dose;
use App\Http\Requests\StoreDoseRequest;
use App\Http\Requests\UpdateDoseRequest;

class DoseController extends Controller
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
     * @param  \App\Http\Requests\StoreDoseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dose  $dose
     * @return \Illuminate\Http\Response
     */
    public function show(Dose $dose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dose  $dose
     * @return \Illuminate\Http\Response
     */
    public function edit(Dose $dose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDoseRequest  $request
     * @param  \App\Models\Dose  $dose
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoseRequest $request, Dose $dose)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dose  $dose
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dose $dose)
    {
        //
    }
}
