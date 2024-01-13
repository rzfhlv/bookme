<?php

namespace App\Repositories\Appointment;

use App\Models\Appointment;

class AppointmentRepository
{
    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function create(array $data)
    {
        return $this->appointment::create($data);
    }

    public function all()
    {
        return $this->appointment::paginate(5);
    }

    public function get(int $id)
    {
        return $this->appointment::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        return $this->appointment::findOrFail($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->appointment::findOrFail($id)->delete();
    }
}
