<?php

namespace App\Http\Controllers\Api\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentCreateRequest;
use App\Http\Requests\Appointment\AppointmentUpdateRequest;
use App\Http\Resources\Appointment\AppointmentCollection;
use App\Http\Resources\Appointment\AppointmentDetailResource;
use App\Services\Appointment\AppointmentService;
use Illuminate\Http\Request;
use Throwable;

class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function create(AppointmentCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $appointment = $this->appointmentService->create($data);

            return new AppointmentDetailResource($appointment);
        } catch (Throwable $th) {
            dd($th);
            return $this->generateError($th);
        }
    }

    public function all(Request $request)
    {
        try {
            $appointments = $this->appointmentService->all();

            return new AppointmentCollection($appointments);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function get(Request $request, $id)
    {
        try {
            $appointment = $this->appointmentService->get($id);

            return new AppointmentDetailResource($appointment);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function update(AppointmentUpdateRequest $request, $id)
    {
        try {
            $this->appointmentService->update($request->validated(), $id);
            $appointment = $this->appointmentService->get($id);

            return new AppointmentDetailResource($appointment);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->appointmentService->delete($id);

            return $this->responseBasic();
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
