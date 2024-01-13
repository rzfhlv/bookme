<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryDetailResource;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(CategoryCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $category = $this->categoryService->create($data);

            return new CategoryDetailResource($category);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function all(Request $request)
    {
        try {
            $categories = $this->categoryService->all();

            return new CategoryCollection($categories);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function get(Request $request, $id)
    {
        try {
            $category = $this->categoryService->get($id);

            return new CategoryDetailResource($category);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        try {
            $this->categoryService->update($request->validated(), $id);
            $category = $this->categoryService->get($id);

            return new CategoryDetailResource($category);
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $this->categoryService->delete($id);

            return $this->responseBasic();
        } catch (Throwable $th) {
            return $this->generateError($th);
        }
    }
}
