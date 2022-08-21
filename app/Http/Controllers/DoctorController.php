<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use App\Models\Department;

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
     */
    public function store(DoctorRequest $request)
    {
        DB::beginTransaction();
        try {
            $doctor =  Doctor::with('profile')->get();
            $doctor->fill($request->all());
            $doctor->save();
            DB::commit();
            return response()->json(['message' => 'Doctor has been created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        // $doctor = Doctor::with('profile')->get();
       
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
