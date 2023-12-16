<?php
require("../config/database.php");

class ServicePlante extends Database
{
    protected $db;

    public function addPlante(Plante $plante)
    {
        $this->db = $this->connect();

        // Get properties from the Plante object
        $nom_plante = $plante->getNomPlante();
        $prix_plante = $plante->getPrix();
        $image_plante = $plante->getImagePlant();
        
        // Get the associated category ID
        $categorie = $plante->getCategorie();
        $idCategorie = $categorie->getIdCategorie();

        // Prepare and execute the SQL statement
        $new_plante = "INSERT INTO plante (nomPlante, idCategorie, imagePlant, prix) 
        VALUES (:nomPlant, :idCat, :imagePlant, :prixPlant)";
        $stmt = $this->db->prepare($new_plante);
        $stmt->bindparam(":nomPlant", $nom_plante);
        $stmt->bindparam(":idCat", $idCategorie);
        $stmt->bindparam(":imagePlant", $image_plante);
        $stmt->bindparam(":prixPlant", $prix_plante);

        $stmt->execute();
    }
}
?>
