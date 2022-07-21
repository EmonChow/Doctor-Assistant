<?php

namespace App\Http\Controllers;

use App\Models\DrugTypes;
use App\Http\Requests\StoreDrugTypesRequest;
use App\Http\Requests\UpdateDrugTypesRequest;

class DrugTypesController extends Controller
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
     * @param  \App\Http\Requests\StoreDrugTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDrugTypesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugTypes  $drugTypes
     * @return \Illuminate\Http\Response
     */
    public function show(DrugTypes $drugTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrugTypes  $drugTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(DrugTypes $drugTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDrugTypesRequest  $request
     * @param  \App\Models\DrugTypes  $drugTypes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDrugTypesRequest $request, DrugTypes $drugTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugTypes  $drugTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugTypes $drugTypes)
    {
        //
    }
}
