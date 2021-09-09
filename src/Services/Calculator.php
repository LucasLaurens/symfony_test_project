<?php

namespace App\Services;

class Calculator 
{
    public function tva(float $prix, float $tva): float
    {
        return $prix * ($tva / 100);
    }
}