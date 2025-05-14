<?php

namespace App\Models;

class Room
{
    private int $id;
    private string $name;
    private ?Player $playerOne = null;
    private ?Player $playerTwo = null;

    private function __construct() {}

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function addPlayer(Player $player): void
    {
        if ($this->playerOne === null) {
            $this->playerOne = $player;
        } elseif ($this->playerTwo === null) {
            $this->playerTwo = $player;
        }
    }

    public function available(): bool
    {
        return $this->playerOne === null || $this->playerTwo === null;
    }

    public function gameStartAllowed(): bool
    {
        return $this->playerOne !== null && $this->playerTwo !== null;
    }

    public function playerOne(): ?Player
    {
        return $this->playerOne;
    }

    public function playerTwo(): ?Player
    {
        return $this->playerTwo;
    }

    public static function createSimple(string $name): self
    {
        $room = new self();
        $room->name = $name;
        return $room;
    }

    public static function create(int $id, string $name): self
    {
        $room = new self();
        $room->id = $id;
        $room->name = $name;
        return $room;
    }
}
