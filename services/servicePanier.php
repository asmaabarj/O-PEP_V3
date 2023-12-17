<?php

require_once("../config/database.php");
require_once("../models/panier.php");

require_once("../models/plante.php");


class ServicePanier extends Database
{
    protected $db;

    public function insertPanier($idutilisateur,$idPlant){
    $db = $this->connect();



    $new_panier = "INSERT INTO panier (idutilisateur,idPlante) VALUES (:idutilisateur,:idPlant)";
    $stmt = $db->prepare($new_panier);
    $stmt->bindparam(":idutilisateur", $idutilisateur);
    $stmt->bindparam(":idPlant", $idPlant);
    $stmt->execute();
}
 
public function ShowPanierplante(){

    $db = $this->connect();

    $query = "SELECT p.* 
    FROM plante p 
    JOIN panier pa ON p.idPlante = pa.idPlante ";
    $panier = $db->query($query);
    $result = $panier->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $plnt) {
        $combinedData = new plant(
            $plnt["nomPlante"],
            $plnt["idCategorie"],
            $plnt["imagePlant"],
            $plnt["prix"],
           
        );

        $plantes[] = $combinedData;
    }

    return $plantes;
}
 }



?>