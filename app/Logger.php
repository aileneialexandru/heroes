<?php

namespace App;

trait Logger
{
    public function log(string $message, string $color = 'white'): void
    {
        $colorCodes = [
            'red'   => "\033[31m",
            'green' => "\033[32m",
            'white' => "\033[39m",
        ];

        if (array_key_exists($color, $colorCodes)) {
            echo $colorCodes[$color];
        }

        echo $message . "\n";
    }
}