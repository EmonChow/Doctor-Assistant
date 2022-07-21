<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dose;
use App\Http\Requests\DoseRequest;

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
     * @param  \App\Http\Requests\DoseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoseRequest $request)
    {
        $dose = new Dose();
        $dose->fill($request->all());
        if ($dose->save()) {
            return response()->json(['message' => 'Dose Created Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
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
     * @param  \App\Http\Requests\DoseRequest  $request
     * @param  \App\Models\Dose  $dose
     * @return \Illuminate\Http\Response
     */
    public function update(DoseRequest $request, Dose $dose)
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
