<?php

require_once("../config/database.php");
require_once("../models/Commande.php");


class ServiceCommande extends Database
{
    protected $db;

    public function TotalCommand()
{
    $this->db = $this->connect();

    $x="SELECT COUNT(idCommande) AS y FROM commande  ";
$sqlx=$this->db->query("$x");
return $sqlx->fetch(PDO::FETCH_ASSOC);


    
}

public function insertCommand($idutilisateur,$idPlant){
    $db = $this->connect();



    $new_panier = "INSERT INTO commande (idutilisateur,idPlante) VALUES (:idutilisateur,:idPlant)";
    $stmt = $db->prepare($new_panier);
    $stmt->bindparam(":idutilisateur", $idutilisateur);
    $stmt->bindparam(":idPlant", $idPlant);
    $stmt->execute();
}   
  

}

?>