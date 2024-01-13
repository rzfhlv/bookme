<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ClientCreateRequest;
use App\Http\Requests\Client\ClientUpdateRequest;
use App\Http\Resources\Client\ClientCollection;
use App\Http\Resources\Client\ClientDetailResource;
use App\Services\Client\ClientService;
use Illuminate\Http\Request;
use Throwable;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function create(ClientCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $client = $this->clientService->create($data);

            return new ClientDetailResource($client);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function all(Request $request)
    {
        try {
            $clients = $this->clientService->all();

            return new ClientCollection($clients);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function get(Request $request, $id)
    {
        try {
            $client = $this->clientService->get($id);

            return new ClientDetailResource($client);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function update(ClientUpdateRequest $request, $id)
    {
        try {
            $this->clientService->update($request->validated(), $id);
            $client = $this->clientService->get($id);

            return new ClientDetailResource($client);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->clientService->delete($id);

            return $this->responseBasic();
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
