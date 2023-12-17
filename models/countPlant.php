<?php
class CountPlant
{
    private $totalPlantes;

    public function __construct($totalPlantes)
    {
        $this->totalPlantes = $totalPlantes;
    }

    public function getTotalPlante()
    {
        return $this->totalPlantes;
    }
}