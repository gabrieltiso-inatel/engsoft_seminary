<?php

namespace App\Infra\Db;

use App\Models\Player;

class PlayerRepository {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createPlayer($name)
    {
        $stmt = $this->db->prepare("INSERT INTO players (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        return Player::create($this->db->lastInsertRowID(), $name);
    }

    public function getPlayerById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM players WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();

        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            return Player::create($row['id'], $row['name']);
        }

        return null;
    }
} 
