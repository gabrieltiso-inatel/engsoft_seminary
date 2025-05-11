
<?php
namespace App\Infra\DB;

use PDO;
use PDOException;

function connectToDatabase(): PDO {
    try {
        $databasePath = __DIR__ . '/database.sqlite';
        $connection = new PDO('sqlite:' . $databasePath);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}
?>