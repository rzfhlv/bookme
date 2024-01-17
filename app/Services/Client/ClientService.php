<?php

namespace App\Services\Client;

use App\Http\Requests\Client\ClientPictureRequest;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Storage\StorageRepository;
use Illuminate\Support\Facades\DB;
use Throwable;

class ClientService
{
    protected const PATH_IMAGE = 'public/images/client';
    protected const DISK = 'local';

    protected $clientRepository;
    protected $storageRepository;

    public function __construct(
        ClientRepository $clientRepository,
        StorageRepository $storageRepository,
    ) {
        $this->clientRepository = $clientRepository;
        $this->storageRepository = $storageRepository;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $client = $this->clientRepository->create($data);
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();

        return $client;
    }

    public function storePicture(ClientPictureRequest $request, int $id)
    {
        $path = self::PATH_IMAGE;
        $disk = self::DISK;

        DB::beginTransaction();
        try {
            $picture = $request->file('picture');
            $path = $this->storageRepository->putFile($path, $picture, $disk);
            $pictureName = $this->storageRepository->url($path, $disk);
            $data["picture"] = $pictureName;

            $this->update($data, $id);
            $client = $this->get($id);
        } catch (Throwable $th) {
            DB::rollBack();
            $this->storageRepository->delete([$path], $disk);
            throw $th;
        }
        DB::commit();

        return $client;
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
