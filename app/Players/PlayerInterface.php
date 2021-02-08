<?php

namespace App\Players;

interface PlayerInterface
{
    public function getHealth(): int;
    public function getStrength(): int;
    public function getDefence(): int;
    public function getSpeed(): int;
    public function getLuck(): int;
    public function getName(): string;
    public function attack(PlayerInterface &$player);
    public function receiveHit(int $damage);
    public function isAlive(): bool;
}