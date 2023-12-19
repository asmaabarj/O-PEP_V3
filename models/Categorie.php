<?php

class Categorie
{
    private $idCategorie;
    private $nomCategorie;
    public function __construct($idCategorie,$nomCategorie)
    {
        $this->nomCategorie = $nomCategorie;
        $this->idCategorie = $idCategorie;
    }
        public function getIdCategorie()
    {
        return $this->idCategorie;
    }
    public function getNomCategorie()
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie($nomCategorie)
    {
        $this->nomCategorie = $nomCategorie;
    } 
}
?>