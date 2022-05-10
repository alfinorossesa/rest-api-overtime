<?php

namespace App\Repositories;

interface EmployeeRepositoryInterface
{
    public function all();
    public function store($request);
}