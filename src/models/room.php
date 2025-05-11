<?php

namespace App\Models;

class Room
{
    private int $id;
    private string $name;
    private ?Player $playerOne = null;
    private ?Player $playerTwo = null;

    public function __construct(string $name)
    {
        $this->name = $name;
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
}
