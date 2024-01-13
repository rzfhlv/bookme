<?php

namespace App\Services\Schedule;

use App\Repositories\Schedule\ScheduleRepository;

class ScheduleService
{
    protected $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function create(array $data)
    {
        return $this->scheduleRepository->create($data);
    }

    public function all()
    {
        return $this->scheduleRepository->all();
    }

    public function get(int $id)
    {
        return $this->scheduleRepository->get($id);
    }

    public function update(array $data, int $id)
    {
        return $this->scheduleRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->scheduleRepository->delete($id);
    }
}
