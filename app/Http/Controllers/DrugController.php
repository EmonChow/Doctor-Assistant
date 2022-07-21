<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrugRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Models\Drug;
use Illuminate\Support\Facades\DB;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {

        $drug_query = Drug::query();

        $trade_name = $request->tradename;
        $generic_name = $request->genericname;

        if($trade_name){
            $drug = $drug_query->where('trade_name', 'like', '%' . $trade_name . '%');
        }

        if($generic_name){
            $drug = $drug_query->where('generic_name', 'like', '%' . $generic_name . '%');
        }

          $drug = $drug_query->orderBy('id', 'DESC')->paginate(10);

          return response()->json([
            'data'=> $drug
             ],200);
        

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
