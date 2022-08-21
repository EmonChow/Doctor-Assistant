<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $doctors = Doctor::paginate();
        return response()->json($doctors);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\DoctorRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(DoctorRequest $request)
    {
        DB::beginTransaction();
        try {
            // Create Doctor
            $doctor = Doctor::create($request->only(['title', 'description', 'department_id']));
            // Create User for Doctor
            $user = new User();
            $user->fill($request->only(['name', 'photo', 'email']));
            $user->password = Hash::make($request->password);
            $user->save();
            // Assign Role
            $user->assignRole('Doctor');
            // Apply Polymorphic Relation
            $doctor->user()->save($user);

            $department = new Department();
            $department->fill($request->only(['name', 'description']));
            $department->save();
            DB::commit();
            return response()->json(['message' => 'Doctor has been created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\DoctorRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DoctorRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
