<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DrugAdvice;
use App\Http\Requests\DrugAdviceRequest;


class DrugAdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $advice_query = DrugAdvice::query();

        $advice = $request->advice;

        if ($advice) {
            $advice = $advice_query->where('advice', 'like', '%' .  $advice . '%');
        }

        $advice = $advice_query->orderBy('id', 'DESC')->paginate(10);

        return response()->json(
            [
                'data' => $advice
            ],
            200
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DrugAdviceRequest  $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (DrugAdvice::destroy($id)) {
            return response()->json(['message' => 'Drug Advice has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
