<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Requests\PatientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Filters\PatientFilter;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $patient_query = Patient::withFilter(new PatientFilter, $request)
            ->orderBy('id', 'DESC')
            ->with('user')
            ->paginate($request->query('limit'));
        return response()->json($patient_query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PatientRequest $request)
    {
        DB::beginTransaction();
        try {
            $patient = Patient::create($request->only(['height', 'weight', 'birth_date']));
            $user = new User();
            $user->fill($request->only(['name', 'photo', 'email']));
            $user->password = Hash::make($request->password);
            $user->save();
            $user->assignRole('Patient');
            $patient->user()->save($user);
            DB::commit();
            return response()->json(['message' => 'Patient has been created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    { 
        $patient = Patient::with('user')->findOrFail($id);
        return response()->json($patient);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PatientRequest  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PatientRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            Patient::where('id', auth()->user()->id)->update([
                'height' => $request->height,
                'weight' => $request->weight,
                'birth_date' => $request->birth_date
            ]);
            User::where('id', $id)->update([
                'name' => $request->name,
                'photo' => $request->photo,
                'email' => $request->email,
                'password' => $request->password
            ]);
            DB::commit();
            return response()->json(['message' => 'Patient has been update successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Patient::destroy($id)) {
            return response()->json(['message' => 'Patient has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
