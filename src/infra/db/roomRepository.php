<?php
namespace App\Infra\DB;

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
        $stmt = $this->db->query('SELECT * FROM rooms');
        $rooms = [];

        while ($row = $stmt->fetchArray(SQLITE3_ASSOC)) {
            $rooms[] = Room::create($row['id'], $row['name']);
        }

        return $rooms;
    }

    public function getRoomById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM rooms WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();

        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            return Room::create($row['id'], $row['name']);
        }

        return null;
    }

    public function updateRoom(Room $room)
    {
        # print all the room properties
        echo "Room ID: " . $room->id() . "\n";
        echo "Room Name: " . $room->name() . "\n";
        echo "Player 1 ID: " . ($room->playerOne() ? $room->playerOne()->id() : 'null') . "\n";

        $stmt = $this->db->prepare('UPDATE rooms SET name = :name, player1_id = :player1_id, player2_id = :player2_id WHERE id = :id');
        $stmt->bindValue(':name', $room->name());
        $stmt->bindValue(':player1_id', $room->playerOne() ? $room->playerOne()->id() : null);
        $stmt->bindValue(':player2_id', $room->playerTwo() ? $room->playerTwo()->id() : null);
        $stmt->bindValue(':id', $room->id());

        return $stmt->execute() ? true : false;
    }
}
