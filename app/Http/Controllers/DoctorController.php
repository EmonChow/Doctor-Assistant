<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\DoctorDegree;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Filters\DoctorFilter;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $doctor_query = Doctor::withFilter(new DoctorFilter, $request)
            ->orderBy('id', 'DESC')
            ->paginate($request->query('limit'));
        return response()->json($doctor_query);
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
            $doctor = Doctor::create($request->only(['title', 'description', 'department_id']));
            $user = new User();
            $user->fill($request->only(['name', 'photo', 'email']));
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole('Doctor');
            $doctor->user()->save($user);
            foreach ($request->degrees as $degree) {
                $doctor_degree = new DoctorDegree();
                $doctor_degree->fill($degree);
                $doctor_degree->doctor_id = $doctor->id;
                $doctor_degree->save();
            }
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
        return response()->json(Doctor::findOrFail($id));
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
        DB::beginTransaction();
        try {
            Doctor::where('id', auth()->user()->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'department_id' => $request->idepartment_id
            ]);
            User::where('id', $id)->update([
                'name' => $request->name,
                'photo' => $request->photo,
                'email' => $request->email,
                'password' => $request->password
            ]);
            foreach ($request->degrees as $degree) {
                DoctorDegree::where('doctor_id', $id)->update(["title" => $degree["title"], "description" => $degree["description"]]);
            }
            DB::commit();
            return response()->json(['message' => 'Doctor has been update successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Doctor::destroy($id)) {
            return response()->json(['message' => 'Doctor has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
