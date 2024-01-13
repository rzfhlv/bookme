<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;

class ScheduleRepository
{
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function create(array $data)
    {
        return $this->schedule::create($data);
    }

    public function all()
    {
        return $this->schedule::paginate(5);
    }

    public function get(int $id)
    {
        return $this->schedule::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        return $this->schedule::findOrFail($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->schedule::findOrFail($id)->delete();
    }
}
