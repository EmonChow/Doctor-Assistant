<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrugRequest;
use Illuminate\Http\Request;
use App\Models\Drug;
use Illuminate\Support\Facades\DB;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return response()->json(Drug::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\DrugRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrugRequest $request)
    {
       
        // $drugs = Drug::create($request->all());
        // return $drugs;

        DB::beginTransaction();
        try {
            
            $drugs = Drug::create($request->all());
        
            DB::commit();
            return response()->json(['message' => 'Drug Created Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\DrugRequest $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DrugRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Drug $drug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drug $drug)
    {
        //
    }
}
