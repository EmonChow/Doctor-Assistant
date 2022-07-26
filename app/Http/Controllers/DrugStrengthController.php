<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrugStrength;
use App\Filters\DrugStrengthFilter;
use App\Http\Requests\DrugStrengthRequest;


class DrugStrengthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $drug_strength_query = DrugStrength::withFilter(new DrugStrengthFilter, $request)->orderBy('id', 'DESC')->paginate(10);

        return response()->json(
            [
                'data' => $drug_strength_query
            ],
            200
        );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DrugStrengthRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrugStrengthRequest $request)
    {
        $drug_strength = new DrugStrength();
        $drug_strength->fill($request->all());
        if ($drug_strength->save()) {
            return response()->json(['message' => 'Drug Strength Created Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugStrength  $drugStrength
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(DrugStrength::findOrFail($id));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DrugStrengthRequest  $request
     * @param  \App\Models\DrugStrength  $drugStrength
     * @return \Illuminate\Http\Response
     */
    public function update(DrugStrengthRequest $request, $id)
    {
        $drug_strength = DrugStrength::findOrfail($id);
        $drug_strength->fill($request->all());
        if ($drug_strength->save()) {
            return response()->json(['message' => 'Drug Strength Updated Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugStrength  $drugStrength
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (DrugStrength::destroy($id)) {
            return response()->json(['message' => 'Drug Strength has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
