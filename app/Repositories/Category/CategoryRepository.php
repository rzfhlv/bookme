<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Repository;

class CategoryRepository extends Repository
{
    protected $category;

    public function __construct(Category $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    public function create(array $data)
    {
        return $this->category::create($data);
    }

    public function all()
    {
        return $this->category::paginate($this->getPagination());
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
