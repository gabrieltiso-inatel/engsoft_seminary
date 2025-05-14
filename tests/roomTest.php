<?php

use App\Models\Player;
use App\Models\Room;
use PHPUnit\Framework\TestCase;

final class RoomTest extends TestCase
{
    ### PLAYER ADITION LOGIC ###

    public function testAddPlayerOne()
    {
        $room = Room::createSimple("Test Room");
        $player = Player::createSimple("Player 1");
        $room->addPlayer($player);
        $this->assertEquals($player, $room->playerOne());
    }

    public function testAddPlayerTwo()
    {
        $room = Room::createSimple("Test Room");
        $player1 = Player::createSimple("Player 1");
        $room->addPlayer($player1);

        $player2 = Player::createSimple("Player 2");
        $room->addPlayer($player2);
        $this->assertEquals($player2, $room->playerTwo());
    }

    public function testRommAvailable()
    {
        $room = Room::createSimple("Test Room");
        $this->assertTrue($room->available());

        $player1 = Player::createSimple("Player 1");
        $room->addPlayer($player1);

        $this->assertTrue($room->available());
    }

    public function testCantAddPlayerWhenRoomIsFull()
    {
        $room = Room::createSimple("Test Room");
        $player1 = Player::createSimple("Player 1");
        $player2 = Player::createSimple("Player 2");
        $room->addPlayer($player1);
        $room->addPlayer($player2);

        $this->assertFalse($room->available());
    }

    ### GAME LOGIC ###

    public function testCanStartNewGame()
    {
        $room = Room::createSimple("Test Room");
        $player1 = Player::createSimple("Player 1");
        $player2 = Player::createSimple("Player 2");
        $room->addPlayer($player1);
        $room->addPlayer($player2);

        $this->assertTrue($room->gameStartAllowed());
    }

    public function testCantStartNewGameWhenRoomIsEmpty()
    {
        $room = Room::createSimple("Test Room");
        $this->assertFalse($room->gameStartAllowed());
    }

    public function testCantStartNewGameWhenRoomIsPartiallyFilled()
    {
        $room = Room::createSimple("Test Room");
        $player1 = Player::createSimple("Player 1");
        $room->addPlayer($player1);

        $this->assertFalse($room->gameStartAllowed());
    }

    public function testCanStartNewGameWhenRoomIsFull()
    {
        $room = Room::createSimple("Test Room");
        $player1 = Player::createSimple("Player 1");
        $player2 = Player::createSimple("Player 2");
        $room->addPlayer($player1);
        $room->addPlayer($player2);

        $this->assertTrue($room->gameStartAllowed());
    }
}
