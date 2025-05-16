<?php

namespace App\Infra\Db;

use App\Models\Player;
use App\Models\Room;

class RoomRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createRoom($name)
    {
        $stmt = $this->db->prepare('INSERT INTO rooms (name) VALUES (:name)');
        $stmt->bindValue(':name', $name);
        $result = $stmt->execute();

        return $result ? true : false;
    }


    public function getAllRooms()
    {
        $stmt = $this->db->query(
            'SELECT r.*, 
                p1.id as p1_id, p1.name as p1_name, 
                p2.id as p2_id, p2.name as p2_name
         FROM rooms r
         LEFT JOIN players p1 ON r.player1_id = p1.id
         LEFT JOIN players p2 ON r.player2_id = p2.id'
        );
        $rooms = [];

        while ($row = $stmt->fetchArray(SQLITE3_ASSOC)) {
            $room = Room::create($row['id'], $row['name']);
            if ($row['p1_id']) {
                $player1 = Player::create($row['p1_id'], $row['p1_name']);
                $room->addPlayer($player1);
            }
            if ($row['p2_id']) {
                $player2 = Player::create($row['p2_id'], $row['p2_name']);
                $room->addPlayer($player2);
            }
            $rooms[] = $room;
        }

        return $rooms;
    }

    public function getRoomById($id)
    {
        $stmt = $this->db->prepare(
            'SELECT r.*, 
                p1.id as p1_id, p1.name as p1_name, 
                p2.id as p2_id, p2.name as p2_name
         FROM rooms r
         LEFT JOIN players p1 ON r.player1_id = p1.id
         LEFT JOIN players p2 ON r.player2_id = p2.id
         WHERE r.id = :id'
        );
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();

        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $room = Room::create($row['id'], $row['name']);
            if ($row['p1_id']) {
                $player1 = Player::create($row['p1_id'], $row['p1_name']);
                $room->addPlayer($player1);
            }
            if ($row['p2_id']) {
                $player2 = Player::create($row['p2_id'], $row['p2_name']);
                $room->addPlayer($player2);
            }
            return $room;
        }

        return null;
    }

    public function updateRoom(Room $room)
    {
        $stmt = $this->db->prepare('UPDATE rooms SET name = :name, player1_id = :player1_id, player2_id = :player2_id WHERE id = :id');
        $stmt->bindValue(':name', $room->name());
        $stmt->bindValue(':player1_id', $room->playerOne() ? $room->playerOne()->id() : null);
        $stmt->bindValue(':player2_id', $room->playerTwo() ? $room->playerTwo()->id() : null);
        $stmt->bindValue(':id', $room->id());

        return $stmt->execute() ? true : false;
    }
}
