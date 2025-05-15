<?php

namespace App\Models;

class Player
{
    private int $id;
    private string $name;

    private function __construct() {}

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public static function createSimple(string $name): self
    {
        $player = new self();
        $player->name = $name;
        return $player;
    }

    public static function create(int $id, string $name): self
    {
        $player = new self();
        $player->id = $id;
        $player->name = $name;
        return $player;
    }
}
