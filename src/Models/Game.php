<?php
namespace App\Models;

class Game
{
    private array $board;
    private bool $active;

    public function __construct()
    {
        $this->board = [
            [Turn::Empty, Turn::Empty, Turn::Empty],
            [Turn::Empty, Turn::Empty, Turn::Empty],
            [Turn::Empty, Turn::Empty, Turn::Empty],
        ];
        $this->active = false;
    }

    public function start(): void
    {
        $this->active = true;
    }

    public function placeMove(int $x, int $y, Turn $turn): void
    {
        if ($this->active && $this->board[$x][$y] === Turn::Empty) {
            $this->board[$x][$y] = $turn;
        }

        if ($this->checkWin($turn)) {
            return;
        }

        $this->checkDraw();
    }

    public function checkWin(Turn $turn): bool
    {
        for ($i = 0; $i < 3; $i++) {
            if (($this->board[$i][0] === $turn && $this->board[$i][1] === $turn && $this->board[$i][2] === $turn) ||
                ($this->board[0][$i] === $turn && $this->board[1][$i] === $turn && $this->board[2][$i] === $turn)) {
                $this->active = false;
                return true;
            }
        }
        return false;
    }

    public function checkDraw(): bool
    {
        foreach ($this->board as $row) {
            foreach ($row as $cell) {
                if ($cell === Turn::Empty) {
                    return false;
                }
            }
        }

        $this->active = false;
        return true;
    }

    public function cell(int $x, int $y): Turn
    {
        return $this->board[$x][$y];
    }

    public function active(): bool
    {
        return $this->active;
    }
}
?>