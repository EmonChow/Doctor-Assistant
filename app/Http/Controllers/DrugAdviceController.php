<?php

namespace App\Http\Controllers;

use App\Models\DrugAdvice;
use App\Http\Requests\StoreDrugAdviceRequest;
use App\Http\Requests\UpdateDrugAdviceRequest;

class DrugAdviceController extends Controller
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
     * @param  \App\Http\Requests\StoreDrugAdviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDrugAdviceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugAdvice  $drugAdvice
     * @return \Illuminate\Http\Response
     */
    public function show(DrugAdvice $drugAdvice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrugAdvice  $drugAdvice
     * @return \Illuminate\Http\Response
     */
    public function edit(DrugAdvice $drugAdvice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDrugAdviceRequest  $request
     * @param  \App\Models\DrugAdvice  $drugAdvice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDrugAdviceRequest $request, DrugAdvice $drugAdvice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugAdvice  $drugAdvice
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugAdvice $drugAdvice)
    {
        //
    }
}
