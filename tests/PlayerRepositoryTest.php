<?php

namespace App\Tests;

use App\Infra\Db\Connection;
use App\Infra\Db\PlayerRepository;

final class PlayerRepositoryTest extends \PHPUnit\Framework\TestCase
{
    private Connection $db;
    private PlayerRepository $repository;

    protected function setUp(): void
    {
        try {
            $this->db = new Connection(':memory:');
            $this->db->connect(':memory:');

            $this->repository = new PlayerRepository($this->db->getDb());
        } catch (\Exception $e) {
            $this->fail("Failed to set up database connection: " . $e->getMessage());
        }
    }

    public function testPasses() {
        $this->assertTrue(true);
    }

    public function testCreatePlater() {
        $player = $this->repository->createPlayer('Player 1');
        $this->assertNotNull($player);
    }

    public function testGetPlayerById() {
        $player = $this->repository->createPlayer('Player 1');
        $fetchedPlayer = $this->repository->getPlayerById($player->id());
        $this->assertEquals($player, $fetchedPlayer);
    }

    public function testGetPlayerByIdFails() {
        $fetchedPlayer = $this->repository->getPlayerById(999);
        $this->assertNull($fetchedPlayer);
    }
}