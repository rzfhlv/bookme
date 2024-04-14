<?php

namespace App\Repositories\Appointment;

use App\Models\Appointment;
use App\Repositories\Repository;

class AppointmentRepository extends Repository
{
    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        parent::__construct();
        $this->appointment = $appointment;
    }

    public function create(array $data)
    {
        return $this->appointment::create($data);
    }

    public function all()
    {
        return $this->appointment::paginate($this->getPagination());
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
