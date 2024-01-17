<?php

namespace App\Services\Conselor;

use App\Http\Requests\Conselor\ConselorPictureRequest;
use App\Repositories\Conselor\ConselorRepository;
use App\Repositories\Storage\StorageRepository;
use Illuminate\Support\Facades\DB;
use Throwable;

class ConselorService
{
    protected const PATH_IMAGE = 'public/images/conselor';
    protected const DISK = 'local';

    protected $conselorRepository;
    protected $storageRepository;

    public function __construct(
        ConselorRepository $conselorRepository,
        StorageRepository $storageRepository,
    ) {
        $this->conselorRepository = $conselorRepository;
        $this->storageRepository = $storageRepository;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $conselor = $this->conselorRepository->create($data);
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();

        return $conselor;
    }

    public function storePicture(ConselorPictureRequest $request, int $id)
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
            $conselor = $this->get($id);
        } catch (Throwable $th) {
            DB::rollBack();
            $this->storageRepository->delete([$path], $disk);
            throw $th;
        }
        DB::commit();

        return $conselor;
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
