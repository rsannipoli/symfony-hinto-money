<?php

namespace App\ApiResource;

class OperationResponse
{
    public string $result;

    public function __construct(string $result)
    {
        $this->result = $result;
    }
}