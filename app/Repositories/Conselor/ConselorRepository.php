<?php

namespace App\Repositories\Conselor;

use App\Models\Conselor;

class ConselorRepository
{
    protected $conselor;

    public function __construct(Conselor $conselor)
    {
        $this->conselor = $conselor;
    }

    public function create(array $data)
    {
        return $this->conselor::create($data);
    }

    public function all()
    {
        return $this->conselor::paginate(5);
    }

    public function get(int $id)
    {
        return $this->conselor::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        return $this->conselor::findOrFail($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->conselor::findOrFail($id)->delete();
    }
}
