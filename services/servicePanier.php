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
 
public function ShowPanierplante($id) {
    $db = $this->connect();

    $query = "SELECT p.*
        FROM plante p 
        JOIN panier pa ON p.idPlante = pa.idPlante where pa.idUtilisateur=$id ";
    $panier = $db->query($query);
    $result = $panier->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $plantes = [];
        foreach ($result as $plnt) {
            $combinedData = new plant(
                $plnt["nomPlante"],
                $plnt["idCategorie"],
                $plnt["imagePlant"],
                $plnt["prix"]
            );

            $plantes[] = $combinedData;
        }

        $count = count($result);
        $array = [
            "count"   => $count,
            "plantes" => $plantes
        ];

        return $array;
    }
}


public function clearPanier($id){
    $this->db = $this->connect();
    $deletePanier = "DELETE FROM panier where idUtilisateur=$id";
    $statement = $this->db->prepare($deletePanier);
    try {
        $statement->execute();
    } catch (PDOException $th) {
        die($th->getMessage());
    }
}


public function commandpanier($id) {
    $db = $this->connect();
    $query = "SELECT idPlante FROM panier WHERE idUtilisateur = :userId";
    $statement = $db->prepare($query);

    $statement->bindParam(':userId', $id, PDO::PARAM_INT);

    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}



 }



?>