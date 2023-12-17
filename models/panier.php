<?php

class Panier
{
    private $idPanier;
    private $idutilisateur;
    private $idPlant;

    public function __construct($idPanier, $idutilisateur, $idPlant)
    {
        $this->idPanier = $idPanier;
        $this->idutilisateur = $idutilisateur;
        $this->idPlant = $idPlant;
    }
    public function getIdPanier(){
        return $this->idPanier;
    }
   public function getidutilisateur(){
    return $this->idutilisateur;
   }
    public function getIdPlant()
    {
        return $this->idPlant;
    }


    
}
?>