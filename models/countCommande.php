<?php
class Countcommand
{
    private $totalCommande;

    public function __construct($totalCommande)
    {
        $this->totalCommande = $totalCommande;
    }

    public function getTotalCommand()
    {
        return $this->totalCommande;
    }
}