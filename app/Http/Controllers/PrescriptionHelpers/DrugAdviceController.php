<?php

namespace App\Http\Controllers\PrescriptionHelpers;

use App\Filters\DrugAdviceFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\DrugAdviceRequest;
use App\Models\DrugAdvice;
use Illuminate\Http\Request;


class DrugAdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $advice_query = DrugAdvice::withFilter(new DrugAdviceFilter, $request)->orderBy('id', 'DESC')->paginate($request->query('limit'));
        return response()->json($advice_query);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DrugAdviceRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DrugAdviceRequest $request)
    {
        $drug_advice = new DrugAdvice();
        $drug_advice->fill($request->all());
        if ($drug_advice->save()) {
            return response()->json(['message' => 'Drug Advice Created Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugAdvice  $drugAdvice
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(DrugAdvice::findOrFail($id));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DrugAdviceRequest  $request
     * @param  \App\Models\DrugAdvice  $drugAdvice
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DrugAdviceRequest $request, $id)
    {
        $drug_advice = DrugAdvice::findOrFail($id);
        $drug_advice->fill($request->all());
        if ($drug_advice->save()) {
            return response()->json(['message' => 'Drug Advice Updated Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugAdvice  $drugAdvice
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (DrugAdvice::destroy($id)) {
            return response()->json(['message' => 'Drug Advice has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
