<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;
use App\Filters\ScheduleFilter;
use App\Models\SchedulesDays;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $schedule_query = Schedule::withFilter(new ScheduleFilter, $request)->orderBy('id', 'DESC')->paginate($request->query('limit'));
        return response()->json($schedule_query);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ScheduleRequest $request)
    {
        $schedule_days = new SchedulesDays();
        $schedule_days->fill($request->all());
        $schedule = new Schedule();
        $schedule->fill($request->all());
        if ($schedule . $schedule_days->save()) {
            return response()->json([
                'message' => 'Schedule And Schedule Days Created Successfully',

            ]);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Schedule::findOrFail($id));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->fill($request->all());
        if ($schedule->save()) {
            return response()->json(['message' => 'Schedule Updated Successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Schedule::destroy($id)) {
            return response()->json(['message' => 'Schedule has been deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }
}
