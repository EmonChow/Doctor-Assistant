<?php

namespace App\Http\Controllers\PrescriptionHelpers;

use App\Filters\DoseFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoseRequest;
use App\Models\Dose;
use Illuminate\Http\Request;

class DoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $dose_query = Dose::withFilter(new DoseFilter, $request)->paginate($request->query('limit'));
        return response()->json($dose_query);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\DoseRequest $request
     * @return \Illuminate\Http\JsonResponse
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
     * @param \App\Models\Dose $dose
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Dose::findOrFail($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\DoseRequest $request
     * @param \App\Models\Dose $dose
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DoseRequest $request, $id)
    {
        $dose = Dose::findOrFail($id);
        $dose->fill($request->all());
        if ($dose->save()) {
            return response()->json(['message' => 'Dose Updated Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Dose $dose
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Dose::destroy($id)) {
            return response()->json(['message' => 'Dose has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
