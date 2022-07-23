<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrugTypes;
use App\Http\Requests\DrugTypesRequest;


class DrugTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $drug_types_query = DrugTypes::query();

        $drug_type = $request->drugtype;

        if ($drug_type) {
            $drug_type = $drug_types_query->where('type', 'like', '%' .  $drug_type . '%');
        }

        $drug_type = $drug_types_query->orderBy('id', 'DESC')->paginate(10);

        return response()->json(
            [
                'data' => $drug_type
            ],
            200
        );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DrugTypesRequest  $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (DrugTypes::destroy($id)) {
            return response()->json(['message' => 'Drug Type has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
