<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;
use App\Filters\ScheduleFilter;
use App\Models\ScheduleDayTime;
use App\Models\ScheduleDay;
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
            $this->createSchedule($request, $schedule);
            DB::commit();
            return response()->json(['message' => 'Schedule has been created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    /**
     * Getting all time between start and end time by given interval
     *
     * @param $start_time
     * @param $end_time
     * @param $interval
     * @return CarbonPeriod
     */

    private function getTimeSlots($start_time, $end_time, $interval)
    {
        $start_time = Carbon::parse($start_time);
        $end_time = Carbon::parse($end_time);
        return CarbonPeriod::create($start_time, $interval, $end_time);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Schedule $schedule
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $schedule = Schedule::with('scheduleDaysTimes')->findOrFail($id);
        return response()->json($schedule);
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
        $schedule->save();
        ScheduleDay::where('schedule_id', $id)->delete();
        ScheduleDayTime::where('schedule_day_id', $id)->delete();
        $this->createSchedule($request, $schedule);
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
    /**
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getScheduleByUser($user_id)
    {
        $schedule = Schedule::where('user_id', $user_id)->with('scheduleDaysTimes')->get();
        return response()->json($schedule);
    }

    private function createSchedule(Request $request, Schedule $schedule)
    {
        DB::transaction(function () use ($request, $schedule) {
            foreach ($request->days as $day) {
                $schedule_day = new ScheduleDay();
                $schedule_day->fill($day);
                $schedule_day->schedule_id = $schedule->id;
                $schedule_day->save();
                $slots = $this->getTimeSlots($day['start_time'], $day['end_time'], $day['time_slot'] . 'minutes');
                $schedule_date_time = collect();
                foreach ($slots as $slot) {
                    $schedule_date_time->push([
                        'time' => $slot->toTimeString(),
                        'schedule_day_id' => $schedule_day->id,
                        'created_at' => Carbon::now()
                    ]);
                }
                ScheduleDayTime::insert($schedule_date_time->toArray());
            }
        });
    }
}
