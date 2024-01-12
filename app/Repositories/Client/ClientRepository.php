<?php

namespace App\Repositories\Client;

use App\Models\Client;

class ClientRepository
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(array $data)
    {
        return $this->client::create($data);
    }

    public function all()
    {
        return $this->client::paginate(5);
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
