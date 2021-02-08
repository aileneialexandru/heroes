<?php

namespace App\Players;

use App\Logger;

abstract class AbstractPlayer
{
    use Logger;

    protected int $health;
    protected int $strength;
    protected int $defence;
    protected int $speed;
    protected int $luck;
    protected array $skills;

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getDefence(): int
    {
        return $this->defence;
    }

    public function getSpeed(): int
    {
        return $this->speed;
    }

    public function getLuck(): int
    {
        return $this->luck;
    }

    public function isAlive(): bool
    {
        return $this->health > 0;
    }

    public function isLucky(): bool
    {
        try {
            return random_int(0, 100) < $this->luck;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function attack(PlayerInterface &$player)
    {
        $this->log($this->getName() . ' is attacking ' . $player->getName(), 'green');

        // Deal the damage to the fighting player
        $player->receiveHit($this->getAttackDamage());
    }

    public function receiveHit(int $damage)
    {
        $this->health -= ($damage - $this->defence);

        $this->log($this->getName() . ' received ' . $damage . ' damage', 'red');
    }

    private function getAttackDamage(): int
    {
        return $this->strength;
    }
}