<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;
use App\Filters\ScheduleFilter;
use App\Models\SchedulesDays;
use Illuminate\Support\Facades\DB;

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
     * @param \App\Http\Requests\ScheduleRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(ScheduleRequest $request)
    {
        DB::beginTransaction();
        try {
            $schedule = new Schedule();
            $schedule->fill($request->all());
            $schedule->user_id = auth()->user()->id;
            $schedule->save();

            foreach ($request->days as $day) {
                $schedule_day = new SchedulesDays();
                $schedule_day->fill($day);
                $schedule_day->schedule_id = $schedule->id;
                $schedule->save();
            }
            DB::commit();
            return response()->json(['message' => 'Something went wrong'], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            dump($e);
            throw $e;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Schedule $schedule
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(Schedule::findOrFail($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ScheduleRequest $request
     * @param \App\Models\Schedule $schedule
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
     * @param \App\Models\Schedule $schedule
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
