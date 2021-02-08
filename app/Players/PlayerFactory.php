<?php

namespace App\Players;

class PlayerFactory
{
    public function create(string $type): PlayerInterface
    {
        return match ($type) {
            'orderus' => new Orderus(),
            default   => new WildBeast(),
        };

    }
}