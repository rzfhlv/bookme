<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create(array $data)
    {
        return $this->category::create($data);
    }

    public function all()
    {
        return $this->category::paginate(5);
    }

    public function get(int $id)
    {
        return $this->category::findOrFail($id);
    }

    public function update(array $data, int $id)
    {
        return $this->category::findOrFail($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->category::findOrFail($id)->delete();
    }
}
