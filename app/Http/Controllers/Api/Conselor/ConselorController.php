<?php

namespace App\Http\Controllers\Api\Conselor;

use App\Http\Controllers\Controller;
use App\Services\Conselor\ConselorService;
use App\Http\Requests\Conselor\ConselorCreateRequest;
use App\Http\Requests\Conselor\ConselorPictureRequest;
use App\Http\Requests\Conselor\ConselorUpdateRequest;
use App\Http\Resources\Conselor\ConselorCollection;
use App\Http\Resources\Conselor\ConselorDetailResource;
use Illuminate\Http\Request;
use Throwable;

class ConselorController extends Controller
{
    protected $conselorService;

    public function __construct(ConselorService $conselorService)
    {
        $this->conselorService = $conselorService;
    }

    public function create(ConselorCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $conselor = $this->conselorService->create($data);

            return new ConselorDetailResource($conselor);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function storePicture(ConselorPictureRequest $request, $id)
    {
        try {
            $conselor = $this->conselorService->storePicture($request, $id);

            return new ConselorDetailResource($conselor);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function all(Request $request)
    {
        try {
            $conselors = $this->conselorService->all();

            return new ConselorCollection($conselors);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function get(Request $request, $id)
    {
        try {
            $conselor = $this->conselorService->get($id);

            return new ConselorDetailResource($conselor);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function update(ConselorUpdateRequest $request, $id)
    {
        try {
            $this->conselorService->update($request->validated(), $id);
            $conselor = $this->conselorService->get($id);

            return new ConselorDetailResource($conselor);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->conselorService->delete($id);

            return $this->responseBasic();
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
