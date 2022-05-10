<?php

namespace App\Repositories;

interface OvertimeRepositoryInterface
{
    public function store($request);
    public function get();
    public function calculate();
}