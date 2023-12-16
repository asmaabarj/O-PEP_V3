<?php

class utilisateur
{
    private $idUtilisateur;
    private $idRole;
    private $nomUtilisateur;
    private $prénomUtilisateur;
    private $emailUtilisateur;
    private $MdpUtilisateur;



    public function __construct($idRole,$nomUtilisateur, $prénomUtilisateur, $emailUtilisateur, $MdpUtilisateur)
    {
        $this->idRole = $idRole;
        $this->nomUtilisateur= $nomUtilisateur;
        $this->prénomUtilisateur = $prénomUtilisateur;
        $this->emailUtilisateur = $emailUtilisateur;
        $this->MdpUtilisateur = $MdpUtilisateur;

    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
    public function getIdRole()
    {
        return $this->idRole;
    }

    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    public function getPrénomUtilisateur()
    {
        return $this->prénomUtilisateur;
    }

    public function getEmailUtilisateur()
    {
        return $this->emailUtilisateur;
    }

    public function getMdpUtilisateur()
    {
        return $this->MdpUtilisateur;
    }
    
}
?>
