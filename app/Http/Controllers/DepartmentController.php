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
        $department_query = Department::withFilter(new DepartmentFilter, $request) ->orderBy('id', 'DESC')->paginate($request->query('limit')); 
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
            $this->createDepartmentExamination($request, $department);
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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(DepartmentRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();
        try {
            $department = Department::findOrFail($id);
            $department->fill($request->all());
            $department->save();
            // previous department related data will be delete
            DepartmentExamination::where('department_id', $department->id)->delete();
            $this->createDepartmentExamination($request, $department);
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

    private function createDepartmentExamination(Request $request, Department $department)
    {
        DB::transaction(function () use ($request, $department) {
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
        });
    }
}
