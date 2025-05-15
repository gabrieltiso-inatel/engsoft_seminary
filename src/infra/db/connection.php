<?php
namespace App\Infra\Db;

use SQLite3;

class Connection
{
    private $db;

    public function __construct($filename)
    {
        $this->db = $this->connect($filename);
    }

    public function connect($filename)
    {
        $db = new SQLite3($filename, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
        $db->enableExceptions(true);

        $db->query('CREATE TABLE IF NOT EXISTS players (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL
        )');
        $db->query('CREATE TABLE IF NOT EXISTS rooms (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            player1_id INTEGER,
            player2_id INTEGER,
            FOREIGN KEY (player1_id) REFERENCES players(id),
            FOREIGN KEY (player2_id) REFERENCES players(id)
        )');

        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db;
    }
}

?>