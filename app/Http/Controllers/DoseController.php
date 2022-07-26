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
    public function index(Request $request)
    {
        $dose_query = Dose::filter($request)->orderBy('id', 'ASC')->paginate(10);

        return response()->json(
            [
                'data' => $dose_query
            ],
            200
        );
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
    public function show($id)
    {
        return response()->json(Dose::findOrFail($id));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DoseRequest  $request
     * @param  \App\Models\Dose  $dose
     * @return \Illuminate\Http\Response
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
     * @param  \App\Models\Dose  $dose
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Dose::destroy($id)) {
            return response()->json(['message' => 'Dose has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
