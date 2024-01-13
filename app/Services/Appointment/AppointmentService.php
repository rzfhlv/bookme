<?php

namespace App\Services\Appointment;

use App\Casts\AppointmentStatus;
use App\Repositories\Appointment\AppointmentRepository;

class AppointmentService
{
    protected $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function create(array $data)
    {
        $data['status'] = AppointmentStatus::SCHEDULED;
        return $this->appointmentRepository->create($data);
    }

    public function all()
    {
        return $this->appointmentRepository->all();
    }

    public function get(int $id)
    {
        return $this->appointmentRepository->get($id);
    }

    public function update(array $data, int $id)
    {
        return $this->appointmentRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->appointmentRepository->delete($id);
    }
}
