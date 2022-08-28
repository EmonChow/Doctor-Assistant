<?php

namespace App\Http\Controllers;

use App\Filters\DepartmentFilter;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\DepartmentExaminationField;
use App\Models\DepartmentExamination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $department_query = Department::withFilter(new DepartmentFilter, $request)
            ->orderBy('id', 'DESC')
            ->with('departmentExamination')
            ->paginate($request->query('limit'));
        return response()->json($department_query);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\DepartmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DepartmentRequest $request)
    {
        DB::beginTransaction();
        try {
            $department = Department::create($request->only(['name', 'description']));
            foreach ($request->department_examinations as $examinations) {
                $department_examination = new DepartmentExamination();
                $department_examination->fill($examinations);
                $department_examination->department_id = $department->id;
                $department_examination->save();
                $examination_field = collect();
                foreach ($examinations["examination_fields"] as $field) {
                    $examination_field->push([
                        'title' => $field["title"],
                        'field_type' => $field["field_type"],
                        'department_examination_id' => $department_examination->id
                    ]);
                }
                DepartmentExaminationField::insert($examination_field->toArray());
            }
            DB::commit();
            return response()->json(['message' => 'Department has been created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
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
        return response()->json(Department::with('departmentExamination')->findOrFail($id));
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
        DB::beginTransaction();
        try {
            $department = Department::findOrFail($id);
            $department->fill($request->all());
            $department->save();
            foreach ($request->department_examinations as $examinations) {
                $department_examination = DepartmentExamination::where("department_id", $id)->get()->first();
                $department_examination["name"] = $examinations["name"];
                $department_examination->save();
                foreach ($examinations["examination_fields"] as $field) {
                    DepartmentExaminationField::where('department_examination_id', $department_examination->id)
                    ->update(["title" => $field["title"], "field_type" => $field["field_type"]]);
                }
            }
            DB::commit();
            return response()->json(['message' => 'Department has been updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
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
