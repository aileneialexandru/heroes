<?php

namespace App;

use App\Players\PlayerInterface;

class Arena
{
    use Logger;

    const MAX_PLAYERS = 2;
    const MAX_TURNS = 20;

    private array $players = [];

    public function __construct(PlayerInterface ...$players)
    {
        if (count($players) > self::MAX_PLAYERS) {
            throw new \Exception(sprintf("This arena can only accommodate only %u players",self::MAX_PLAYERS));
        }
        $this->players = $players;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function startBattle()
    {
        $this->sortPlayers();

        $currentAttackerIndex = 0;

        for ($i = 0 ; $i < self::MAX_TURNS ; $i++) {

            // Current attacker should attack one random player in the arena.
            $opponentIndex = $this->getOpponentIndex($currentAttackerIndex);

            // Launch the attack
            $this->players[$currentAttackerIndex]->attack($this->players[$opponentIndex]);

            // See who is going to attack next.
            $nextAttackerIndex = $this->getNextAttackerIndex($currentAttackerIndex);
            if ($nextAttackerIndex == $currentAttackerIndex) {
                $this->log("We have a winner: " . $this->players[$currentAttackerIndex]->getName());
                exit;
            }

            $currentAttackerIndex = $nextAttackerIndex;

        }

        echo "Nobody won!";
    }

    /**
     * Get remaining alive players in arena.
     *
     * @return int
     */
    private function countAlivePlayers(): int
    {
        $alivePlayers = 0;
        foreach ($this->players as $player) {
            if ($player->isAlive()) {
                $alivePlayers++;
            }
        }

        return $alivePlayers;
    }

    /**
     * Sort players by speed and luck to have a starting order.
     *
     * @return void
     */
    private function sortPlayers(): void
    {
        usort($this->players, function ($a, $b) {
            if ($a->getSpeed() == $b->getSpeed()) {
                return $b->getLuck() - $a->getLuck();
            }
            return $b->getSpeed() - $a->getSpeed();
        });
    }

    /**
     * Get the player index who is going to be attacked.
     * It will return a random ALIVE player from the list EXCEPT the attacker.
     *
     * @param int $currentAttackerIndex
     *
     * @return int
     */
    private function getOpponentIndex(int $currentAttackerIndex): int
    {
        do {
            $randomIndex = rand(0, self::MAX_PLAYERS - 1);

        } while(($randomIndex == $currentAttackerIndex) || !$this->players[$randomIndex]->isAlive());

        return $randomIndex;
    }

    private function getNextAttackerIndex(int $currentAttackerIndex): int
    {
        if ($this->countAlivePlayers() == 1) {
            return $currentAttackerIndex;
        }

        do {
            $currentAttackerIndex++;
            if ($currentAttackerIndex == self::MAX_PLAYERS) {
                $currentAttackerIndex = 0;
            }
        } while (!$this->players[$currentAttackerIndex]->isAlive());

        return $currentAttackerIndex;
    }
}