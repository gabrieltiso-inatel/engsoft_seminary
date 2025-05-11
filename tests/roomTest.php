<?php

use App\Models\Player;
use App\Models\Room;
use PHPUnit\Framework\TestCase;

final class RoomTest extends TestCase
{
    ### PLAYER ADITION LOGIC ###

    public function testAddPlayerOne()
    {
        $room = new Room("Test Room");
        $player = new Player("Player 1");
        $room->addPlayer($player);
        $this->assertEquals($player, $room->playerOne());
    }

    public function testAddPlayerTwo()
    {
        $room = new Room("Test Room");
        $player1 = new Player("Player 1");
        $room->addPlayer($player1);

        $player2 = new Player("Player 2");
        $room->addPlayer($player2);
        $this->assertEquals($player2, $room->playerTwo());
    }

    public function testRommAvailable()
    {
        $room = new Room("Test Room");
        $this->assertTrue($room->available());

        $player1 = new Player("Player 1");
        $room->addPlayer($player1);

        $this->assertTrue($room->available());
    }

    public function testCantAddPlayerWhenRoomIsFull()
    {
        $room = new Room("Test Room");
        $player1 = new Player("Player 1");
        $player2 = new Player("Player 2");
        $room->addPlayer($player1);
        $room->addPlayer($player2);

        $this->assertFalse($room->available());
    }

    ### GAME LOGIC ###

    public function testCanStartNewGame()
    {
        $room = new Room("Test Room");
        $player1 = new Player("Player 1");
        $player2 = new Player("Player 2");
        $room->addPlayer($player1);
        $room->addPlayer($player2);

        $this->assertTrue($room->gameStartAllowed());
    }

    public function testCantStartNewGameWhenRoomIsEmpty()
    {
        $room = new Room("Test Room");
        $this->assertFalse($room->gameStartAllowed());
    }

    public function testCantStartNewGameWhenRoomIsPartiallyFilled()
    {
        $room = new Room("Test Room");
        $player1 = new Player("Player 1");
        $room->addPlayer($player1);

        $this->assertFalse($room->gameStartAllowed());
    }

    public function testCanStartNewGameWhenRoomIsFull()
    {
        $room = new Room("Test Room");
        $player1 = new Player("Player 1");
        $player2 = new Player("Player 2");
        $room->addPlayer($player1);
        $room->addPlayer($player2);

        $this->assertTrue($room->gameStartAllowed());
    }
}
