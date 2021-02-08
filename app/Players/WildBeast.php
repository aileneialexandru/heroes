<?php

namespace App\Players;

class WildBeast extends AbstractPlayer implements PlayerInterface
{
    public function __construct()
    {
        $this->health = rand(60, 90);
        $this->strength = rand(60, 90);
        $this->defence = rand(40, 60);
        $this->speed = rand(40, 60);
        $this->luck = rand(25, 40);
    }

    public function getName(): string
    {
        return 'Wild beast';
    }
}