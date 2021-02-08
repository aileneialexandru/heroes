<?php

namespace App\Skills;

trait RapidStrike
{
    private function hasRapidStrike(): bool
    {
        try {
            return random_int(0, 100) < 10;
        } catch (\Exception $e) {
            return false;
        }
    }
}