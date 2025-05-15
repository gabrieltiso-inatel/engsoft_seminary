<?php

namespace App\Tests;

use App\Models\Game;
use App\Models\Turn;

final class GameTest extends \PHPUnit\Framework\TestCase
{
    public function testCanStartNewGame()
    {
        $game = new Game();
        $this->assertFalse($game->active());
    }

    public function testCantPlaceMoveWhenGameIsNotActive()
    {
        $game = new Game();
        $game->placeMove(1, 1, Turn::X);

        $this->assertEquals(Turn::Empty, $game->cell(1, 1));
    }

    public function testCanPlaceMoveWhenGameIsActive()
    {
        $game = new Game();
        $game->start();
        $game->placeMove(1, 1, Turn::X);

        $this->assertEquals(Turn::X, $game->cell(1, 1));
    }

    public function testCantPlaceMoveOnOccupiedCell()
    {
        $game = new Game();
        $game->start();
        $game->placeMove(1, 1, Turn::X);
        $game->placeMove(1, 1, Turn::O);

        $this->assertEquals(Turn::X, $game->cell(1, 1));
    }

    public function testXWinsHorizontal()
    {
        $game = new Game();
        $game->start();

        $game->placeMove(0, 0, Turn::X);
        $game->placeMove(0, 1, Turn::X);
        $game->placeMove(0, 2, Turn::X);

        $this->assertEquals(Turn::X, $game->cell(0, 0));
        $this->assertEquals(Turn::X, $game->cell(0, 1));
        $this->assertEquals(Turn::X, $game->cell(0, 2));

        $this->assertFalse($game->active());
        $this->assertTrue($game->checkWin(Turn::X));
    }

    public function testXWinsVertical()
    {
        $game = new Game();
        $game->start();

        $game->placeMove(0, 0, Turn::X);
        $game->placeMove(1, 0, Turn::X);
        $game->placeMove(2, 0, Turn::X);

        $this->assertEquals(Turn::X, $game->cell(0, 0));
        $this->assertEquals(Turn::X, $game->cell(1, 0));
        $this->assertEquals(Turn::X, $game->cell(2, 0));

        $this->assertFalse($game->active());
        $this->assertTrue($game->checkWin(Turn::X));
    }

    public function testOWinsHorizontal()
    {
        $game = new Game();
        $game->start();

        $game->placeMove(1, 0, Turn::O);
        $game->placeMove(1, 1, Turn::O);
        $game->placeMove(1, 2, Turn::O);

        $this->assertEquals(Turn::O, $game->cell(1, 0));
        $this->assertEquals(Turn::O, $game->cell(1, 1));
        $this->assertEquals(Turn::O, $game->cell(1, 2));

        $this->assertFalse($game->active());
        $this->assertTrue($game->checkWin(Turn::O));
    }

    public function testOWinsVertical()
    {
        $game = new Game();
        $game->start();

        $game->placeMove(0, 0, Turn::O);
        $game->placeMove(1, 0, Turn::O);
        $game->placeMove(2, 0, Turn::O);

        $this->assertEquals(Turn::O, $game->cell(0, 0));
        $this->assertEquals(Turn::O, $game->cell(1, 0));
        $this->assertEquals(Turn::O, $game->cell(2, 0));

        $this->assertFalse($game->active());
        $this->assertTrue($game->checkWin(Turn::O));
    }

    public function testDraw()
    {
        $game = new Game();
        $game->start();
        $game->placeMove(0, 0, Turn::X);
        $game->placeMove(0, 1, Turn::O);
        $game->placeMove(0, 2, Turn::X);
        $game->placeMove(1, 0, Turn::O);
        $game->placeMove(1, 1, Turn::X);
        $game->placeMove(1, 2, Turn::O);
        $game->placeMove(2, 0, Turn::O);
        $game->placeMove(2, 1, Turn::X);
        $game->placeMove(2, 2, Turn::O);

        $this->assertFalse($game->active());
        $this->assertTrue($game->checkDraw());
    }
}
