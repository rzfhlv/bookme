<?php

namespace App\Repositories\Client;

use App\Models\Client;
use App\Repositories\Repository;

class ClientRepository extends Repository
{
    protected $client;

    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    public function create(array $data)
    {
        return $this->client::create($data);
    }

    public function all()
    {
        return $this->client::paginate($this->getPagination());
    }

    public function get(int $id)
    {
        return $this->client::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        return $this->client::findOrFail($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->client::findOrFail($id)->delete();
    }
}
