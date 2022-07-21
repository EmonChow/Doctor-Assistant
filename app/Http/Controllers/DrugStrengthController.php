<?php

namespace App\Http\Controllers;

use App\Models\DrugStrength;
use App\Http\Requests\StoreDrugStrengthRequest;
use App\Http\Requests\UpdateDrugStrengthRequest;

class DrugStrengthController extends Controller
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
     * @param  \App\Http\Requests\StoreDrugStrengthRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDrugStrengthRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugStrength  $drugStrength
     * @return \Illuminate\Http\Response
     */
    public function show(DrugStrength $drugStrength)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrugStrength  $drugStrength
     * @return \Illuminate\Http\Response
     */
    public function edit(DrugStrength $drugStrength)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDrugStrengthRequest  $request
     * @param  \App\Models\DrugStrength  $drugStrength
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDrugStrengthRequest $request, DrugStrength $drugStrength)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugStrength  $drugStrength
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugStrength $drugStrength)
    {
        //
    }
}
