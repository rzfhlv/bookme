<?php

namespace App\Http\Controllers\Api\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\ScheduleCreateRequest;
use App\Http\Requests\Schedule\ScheduleUpdateRequest;
use App\Http\Resources\Schedule\ScheduleCollection;
use App\Http\Resources\Schedule\ScheduleDetailResource;
use App\Services\Schedule\ScheduleService;
use Illuminate\Http\Request;
use Throwable;

class ScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    public function create(ScheduleCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $schedule = $this->scheduleService->create($data);

            return new ScheduleDetailResource($schedule);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function all(Request $request)
    {
        try {
            $schedules = $this->scheduleService->all();

            return new ScheduleCollection($schedules);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function get(Request $request, $id)
    {
        try {
            $schedule = $this->scheduleService->get($id);

            return new ScheduleDetailResource($schedule);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function update(ScheduleUpdateRequest $request, $id)
    {
        try {
            $this->scheduleService->update($request->validated(), $id);
            $schedule = $this->scheduleService->get($id);

            return new ScheduleDetailResource($schedule);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->scheduleService->delete($id);

            return $this->responseBasic();
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
