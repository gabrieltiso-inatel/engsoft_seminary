<?php

namespace App\Tests;

use App\Infra\Db\Connection;
use App\Infra\Db\RoomRepository;
use App\Models\Player;
use PHPUnit\Framework\TestCase;

final class RoomRepositoryTest extends TestCase
{
    private Connection $db;
    private RoomRepository $repository;

    protected function setUp(): void
    {
        try {
            $this->db = new Connection(':memory:');
            $this->db->connect(':memory:');

            $this->repository = new RoomRepository($this->db->getDb());
        } catch (\Exception $e) {
            $this->fail("Failed to set up database connection: " . $e->getMessage());
        }
    }

    public function testCreateRoom()
    {
        $ret = $this->repository->createRoom("Test Room");
        $this->assertTrue($ret, "Failed to create room");
    }

    public function testGetAllRooms()
    {
        $room1 = $this->repository->createRoom("Room 1");
        $room2 = $this->repository->createRoom("Room 2");

        $rooms = $this->repository->getAllRooms();

        $this->assertCount(2, $rooms);
        $this->assertEquals("Room 1", $rooms[0]->name());
        $this->assertEquals("Room 2", $rooms[1]->name());
    }

    public function testGetRoomByIdSucceeds()
    {
        $this->repository->createRoom("Test Room");
        $fetchedRoom = $this->repository->getRoomById(1);

        $this->assertEquals(1, $fetchedRoom->id());
        $this->assertEquals("Test Room", $fetchedRoom->name());
    }

    public function testGetRoomByIdFails()
    {
        $fetchedRoom = $this->repository->getRoomById(999);
        $this->assertNull($fetchedRoom);
    }

    public function testUpdateRoomAddPlayer()
    {
        $player = Player::create(1, "Player 1");
        $this->repository->createRoom("Test Room");

        $room = $this->repository->getRoomById(1);
        $room->addPlayer($player);

        $result = $this->repository->updateRoom($room);
        $this->assertTrue($result, "Failed to update room with player");

        $fetchedRoom = $this->repository->getRoomById(1);
        $this->assertEquals($player->id(), $fetchedRoom->playerOne()->id(), "Player 1 ID does not match");
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->repository);
    }
}
