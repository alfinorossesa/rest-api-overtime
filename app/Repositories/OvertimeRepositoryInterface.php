<?php

namespace App\Repositories;

interface OvertimeRepositoryInterface
{
    public function store($request);
    public function getAll();
    public function calculate();
}