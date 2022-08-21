<?php

namespace App\Http\Controllers;

use App\Filters\AppointmentFilter;
use App\Models\Appointment;
use App\Http\Requests\AppointmentRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $appointment_query = Appointment::withFilter(new AppointmentFilter, $request)
            ->orderBy('id', 'DESC')->paginate($request->query('limit'));
        return response()->json($appointment_query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\AppointmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AppointmentRequest $request)
    {
        DB::beginTransaction();
        try {
            $schedule = Schedule::where('user_id', $request->user_id)->with('scheduleDaysTimes')->get();
            if (count($schedule) < 1) {
                return response()->json(['message' => 'Schedule not found for the doctor'], 400);
            }
            $appointment = new Appointment();
            $appointment->fill($request->all());
            $appointment->save();
            DB::commit();
            return response()->json(['message' => 'Appointment has been created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return response()->json($appointment);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAppointmentRequest $request
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AppointmentRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $schedule = Schedule::where('user_id', $request->user_id)->with('scheduleDaysTimes')->get();
            if (count($schedule) < 1) {
                return response()->json(['message' => 'Schedule not found for the doctor'], 400);
            }
            $appointment = Appointment::findOrFail($id);
            $appointment->fill($request->all());
            $appointment->save();
            DB::commit();
            return response()->json(['message' => 'Appointment has been updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return response()->json(['message' => 'Something went wrong'], 400);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Appointment $appointment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Appointment::destroy($id)) {
            return response()->json(['message' => 'Appointment has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
