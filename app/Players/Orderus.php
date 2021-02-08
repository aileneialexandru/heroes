<?php

namespace App\Players;

use App\Skills\MagicShield;
use App\Skills\RapidStrike;

class Orderus extends AbstractPlayer implements PlayerInterface
{
    use RapidStrike, MagicShield;

    public function __construct()
    {
        $this->health = rand(70, 100);
        $this->strength = rand(70, 80);
        $this->defence = rand(45, 55);
        $this->speed = rand(40, 45);
        $this->luck = rand(10, 30);
    }

    public function attack(PlayerInterface &$player)
    {
        parent::attack($player);

        if ($this->hasRapidStrike()) {
            $this->log($this->getName() . ' used rapid strike');
            $this->attack($player);
        }
    }

    public function receiveHit(int $damage)
    {
        $damageTaken = $damage - $this->defence;

        if ($this->hasMagicShield()) {
            $this->log($this->getName() . ' used magic shield');
            $damageTaken = $damageTaken / 2;
        }

        $this->health -= $damageTaken;

        $this->log($this->getName() . ' received ' . $damageTaken . ' damage', 'red');
    }

    public function getName(): string
    {
        return 'Orderus';
    }
}