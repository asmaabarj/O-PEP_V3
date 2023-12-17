<?php
class Count
{
    private $totalPlants;
    private $nomCategorie;
    

    public function __construct($totalPlants, $nomCategorie)
    {
        $this->totalPlants = $totalPlants;
        $this->nomCategorie = $nomCategorie;
    }

    public function getTotalPlante()
    {
        return $this->totalPlants;
    }

    public function getNomCategorie()
    {
        return $this->nomCategorie;
    }
}