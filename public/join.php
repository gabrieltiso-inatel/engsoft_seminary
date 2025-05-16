<?php 
use App\Infra\Db\Connection;
use App\Infra\Db\RoomRepository;
use App\Models\Player;

function handleJoinRoom($username, $roomName) {
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Join Room</title>
</head>
<body>
    <h1>Join a Room</h1>
    <form method="post" action="join.php">
        <label for="username">User Name:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="room">Room:</label>
        <input type="text" id="room" name="room" required><br><br>
        
        <button type="submit">Join</button>
    </form>
</body>
</html>