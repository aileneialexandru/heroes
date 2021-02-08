<?php

namespace App\Skills;

trait MagicShield
{
    private function hasMagicShield(): bool
    {
        try {
            return random_int(0, 100) < 20;
        } catch (\Exception $e) {
            return false;
        }
    }
}