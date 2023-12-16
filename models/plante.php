<?php

class Plante
{
    private $idPlante;
    private $nomPlante;
    private $prix;
    private $imagePlant;
    
    /** @var Categorie */
    private $categorie;

    public function __construct($nomPlante, Categorie $categorie, $imagePlant, $prix)
    {
        $this->nomPlante = $nomPlante; 
        $this->prix = $prix;
        $this->imagePlant = $imagePlant;
        $this->categorie = $categorie;
    }
    

    public function getIdPlante()
    {
        return $this->idPlante;

    }
    public function getNomPlante()
    {
        return $this->nomPlante;
    }

    public function setNomPlante($nomPlante)
    {
        $this->nomPlante = $nomPlante;
    }
    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }
    public function getImagePlant()
    {
        return $this->imagePlant;
    }

    public function setImagePlant($imagePlant)
    {
        $this->imagePlant = $imagePlant;
    }
    public function getCategorie()
    {
        return $this->categorie;

    }

    
}
?>