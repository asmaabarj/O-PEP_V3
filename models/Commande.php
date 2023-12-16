<?php

class Commande
{
    private $idCommande;
    private $idutilisateur;
    private $idPlant;

    public function __construct($idCommande, $idutilisateur, $idPlant)
    {
        $this->idCommande = $idCommande;
        $this->idutilisateur = $idutilisateur;
        $this->idPlant = $idPlant;
    }
    public function getIdCommande(){
        return $this->idCommande;
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