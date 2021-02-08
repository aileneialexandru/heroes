<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Arena;
use App\Players\PlayerFactory;

// Initialize player spawning factory.
$playerGenerator = new PlayerFactory();
$players = [
    $playerGenerator->create('orderus'),
    $playerGenerator->create('beast'),
];

// Create a battle arena.
$arena = new Arena(...$players);


// Start the battle
$arena->startBattle();