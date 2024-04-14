<?php

namespace App\Repositories\Conselor;

use App\Models\Conselor;
use App\Repositories\Repository;

class ConselorRepository extends Repository
{
    protected $conselor;

    public function __construct(Conselor $conselor)
    {
        parent::__construct();
        $this->conselor = $conselor;
    }

    public function create(array $data)
    {
        return $this->conselor::create($data);
    }

    public function all()
    {
        return $this->conselor::paginate($this->getPagination());
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
