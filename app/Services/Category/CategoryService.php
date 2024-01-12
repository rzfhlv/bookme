<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function get(int $id)
    {
        return $this->categoryRepository->get($id);
    }

    public function update(array $data, int $id)
    {
        return $this->categoryRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->categoryRepository->delete($id);
    }
}
