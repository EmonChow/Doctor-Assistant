<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;
use App\Filters\ScheduleFilter;
use App\Models\ScheduleDaysTime;
use App\Models\SchedulesDays;
use Illuminate\Support\Facades\DB;
use DateTime;

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
                $schedule_day->save();
            }
            $schedule_day_time = new ScheduleDaysTime();
            $schedule_day_time->fill($request->all());
            $schedule_day_time->schedules_day_id = $schedule_day->id;
            $schedule_day_time->save();

            $timeSchedule = [];

            foreach ($request->days as $value) {
                $day = $value["day"];
                $slotTime = $value["time_slot"];
                $startTime = $value["start_time"];
                $endTime = $value["end_time"];
                $slots = $this->getTimeSlot($slotTime, $startTime, $endTime);
                $timeSchedule[$day] = $slots;
            }
            DB::commit();
            return response()->json(['schedule_day_time' => $timeSchedule]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    function getTimeSlot($slot_time, $start_time, $end_time)
    {
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i = 0;
        $time = [];
        while (strtotime($startTime) <= strtotime($endTime)) {
            $start = $startTime;
            $end = date('H:i', strtotime('+' . $slot_time . ' minutes', strtotime($startTime)));
            $startTime = $end;
            $i++;
            if (strtotime($startTime) <= strtotime($endTime)) {
                $time["slot" . $i]['start_time'] = $start;
                $time["slot" . $i]['end_time'] = $end;
            }
        }

        return $time;
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
