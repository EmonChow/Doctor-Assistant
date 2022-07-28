<?php

namespace App\Http\Controllers\PrescriptionHelpers;

use App\Filters\DrugTypeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\DrugTypesRequest;
use App\Models\DrugTypes;
use Illuminate\Http\Request;


class DrugTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $drug_type_query = DrugTypes::withFilter(new DrugTypeFilter, $request)->orderBy('id', 'DESC')->paginate($request->query('limit'));
        return response()->json($drug_type_query);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DrugTypesRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DrugTypesRequest $request)
    {
        $drug_types = new DrugTypes();
        $drug_types->fill($request->all());
        if ($drug_types->save()) {
            return response()->json(["message" => "Drug Type Created Successfully"]);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugTypes  $drugTypes
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(DrugTypes::findOrFail($id));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DrugTypesRequest  $request
     * @param  \App\Models\DrugTypes  $drugTypes
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DrugTypesRequest $request, $id)
    {
        $drug_types = DrugTypes::findOrfail($id);
        $drug_types->fill($request->all());
        if ($drug_types->save()) {
            return response()->json(["message" => "Drug Type Updated Successfully"]);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugTypes  $drugTypes
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (DrugTypes::destroy($id)) {
            return response()->json(['message' => 'Drug Type has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
