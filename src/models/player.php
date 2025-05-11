<?php

namespace App\Models;

class Player
{
    private int $id;
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
