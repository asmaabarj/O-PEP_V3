<?php

class Categorie
{
    private $idRole;
    private $nameRole;

    public function __construct($nameRole)
    {
        $this->nameRole = $nameRole;
    }
    public function getIdRole()
    {
        return $this->idRole;

    }
    public function getNameRole()
    {
        return $this->nameRole;
    }

    public function setNameRole($NameRole)
    {
        $this->NameRole = $NameRole;
    }


    
}
?>