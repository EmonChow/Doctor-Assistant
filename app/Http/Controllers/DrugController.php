<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrugRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Drug;
use Illuminate\Support\Facades\DB;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Drug::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DrugRequest $request
     * @return JsonResponse
     */
    public function store(DrugRequest $request)
    {
        $drug = new Drug();
        $drug->fill($request->all());
        if ($drug->save()) {
            return response()->json(['message' => 'Drug Created Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return response()->json(Drug::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DrugRequest $request
     * @param  $id
     * @return JsonResponse
     */
    public function update(DrugRequest $request, $id)
    {
        $drug = Drug::findOrFail($id);
        $drug->fill($request->all());
        if ($drug->save()) {
            return response()->json(['message' => 'Drug Updated Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if (Drug::destroy($id)) {
            return response()->json(['message' => 'Drug has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
