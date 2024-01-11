<?php

namespace App\Services\Conselor;

use App\Repositories\Conselor\ConselorRepository;

class ConselorService
{
    protected $conselorRepository;

    public function __construct(ConselorRepository $conselorRepository)
    {
        $this->conselorRepository = $conselorRepository;
    }

    public function create(array $data)
    {
        return $this->conselorRepository->create($data);
    }

    public function all()
    {
        return $this->conselorRepository->all();
    }

    public function get(int $id)
    {
        return $this->conselorRepository->get($id);
    }

    public function update(array $data, int $id)
    {
        return $this->conselorRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->conselorRepository->delete($id);
    }
}
