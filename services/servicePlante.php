<?php

require_once("../config/database.php");
require_once("../models/plante.php");
require_once("../models/Product.php");


class ServicePlante extends Database
{
    protected $db;

    public function addPlante(Plant $plante)
    {
        $this->db = $this->connect();


        $nom_plante = $plante->getNomPlante();
        $prix_plante = $plante->getPrix();
        $image_plante = $plante->getImagePlant();
        $idCategorie = $plante->getIdCategorie();


        $new_plante = "INSERT INTO plante (nomPlante, idCategorie, imagePlant, prix) 
        VALUES (:nomPlant, :idCat, :imagePlant, :prixPlant)";
        $stmt = $this->db->prepare($new_plante);
        $stmt->bindparam(":nomPlant", $nom_plante);
        $stmt->bindparam(":idCat", $idCategorie);
        $stmt->bindparam(":imagePlant", $image_plante);
        $stmt->bindparam(":prixPlant", $prix_plante);

        $stmt->execute();
    }
    public function ShowPlantes()
    {
        $this->db = $this->connect();

        $query = "SELECT p.*, c.nomCategorie
            FROM plante p JOIN categorie c ON p.idCategorie = c.idCategorie";

        $plants = $this->db->query($query);
        $result = $plants->fetchAll(PDO::FETCH_ASSOC);
        $plantes = array();

        foreach ($result as $plnt) {
            $combinedData = new Product(
                $plnt["nomPlante"],
                $plnt["idCategorie"],
                $plnt["imagePlant"],
                $plnt["prix"],
                $plnt["nomCategorie"],
                $plnt["idPlante"]
            );

            $plantes[] = $combinedData;
        }

        return $plantes;
    }
    public function DeletePlant($id)
    {
        $this->db = $this->connect();

        $deletePlante = "DELETE FROM plante WHERE idPlante = :id";
        $statement = $this->db->prepare($deletePlante);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            $statement->execute();
        } catch (PDOException $th) {
            die($th->getMessage());
        }
    }

    public function plantParCat(){
        $this->db = $this->connect();
        $plantCat="SELECT
        nomCategorie,
        (SELECT COUNT(idPlante) FROM plante WHERE idCategorie = c.idCategorie) AS totalPlants
        FROM
        categorie AS c;
        ";
    $sqlRes=$this->db->query("$plantCat");
    return $sqlRes->fetchAll(PDO::FETCH_ASSOC);
    }
    public function totalPlantes(){
        $this->db = $this->connect();
        $A="SELECT COUNT(idPlante) AS totalplante FROM plante  ";
    $sqlA=$this->db->query("$A");
    return $sqlA->fetch(PDO::FETCH_ASSOC);
}
}

?>