<?php

namespace App\Services\Client;

use App\Repositories\Client\ClientRepository;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function create(array $data)
    {
        return $this->clientRepository->create($data);
    }

    public function all()
    {
        return $this->clientRepository->all();
    }

    public function get(int $id)
    {
        return $this->clientRepository->get($id);
    }

    public function update(array $data, int $id)
    {
        return $this->clientRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->clientRepository->delete($id);
    }
}
