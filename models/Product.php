<?php

class Product
{
    private $idPlant;
    private $nomPlante;
    private $idCategorie;
    private $imagePlant;
    private $prix;
    private $nomCategorie;


    public function __construct($nomPlante, $idCategorie, $imagePlant, $prix, $nomCategorie,$idPlant)
    {
        $this->nomPlante = $nomPlante;
        $this->idCategorie = $idCategorie;
        $this->imagePlant = $imagePlant;
        $this->prix = $prix;
        $this->nomCategorie = $nomCategorie;
        $this->idPlant = $idPlant;
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
    public function getNomCategorie(){
        return $this->nomCategorie;
    }
}
?>
