<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $departments = Department::paginate($request->limit);
        return response()->json($departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\DepartmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DepartmentRequest $request)
    {
        $department = new Department();
        $department->fill($request->all());
        if ($department->save()) {
            return response()->json(['message' => 'Department has been saved successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Department::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\DepartmentRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DepartmentRequest $request, $id)
    {
        $dose = Department::findOrFail($id);
        $dose->fill($request->all());
        if ($dose->save()) {
            return response()->json(['message' => 'Department Updated Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Department::destroy($id)) {
            return response()->json(['message' => 'Department has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
    
}
