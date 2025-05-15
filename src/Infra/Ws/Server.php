<?php
namespace App\Infra\Ws;

require __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Player;

echo "Hello from the WebSocket server!\n";
echo Player::createSimple("test")->name() . "\n";