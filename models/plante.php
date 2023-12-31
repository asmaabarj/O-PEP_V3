<?php

class Plant
{
    private $idPlant;
    private $nomPlante;
    private $idCategorie;
    private $imagePlant;
    private $prix;

    public function __construct($nomPlante, $idCategorie, $imagePlant, $prix)
    {
        $this->nomPlante = $nomPlante;
        $this->idCategorie = $idCategorie;
        $this->imagePlant = $imagePlant;
        $this->prix = $prix;
    }

    public function getIdPlant()
    {
        return $this->idPlant;
    }

    public function getNomPlante()
    {
        return $this->nomPlante;
    }

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    public function getImagePlant()
    {
        return $this->imagePlant;
    }

    public function getPrix()
    {
        return $this->prix;
    }
    
}
?>
