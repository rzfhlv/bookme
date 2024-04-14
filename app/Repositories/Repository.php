<?php

namespace App\Repositories;

class Repository
{
    protected $pagination;

    public function __construct()
    {
        $this->pagination = config('additional.pagination');
    }

    public function getPagination()
    {
        return $this->pagination;
    }
}
