<?php
require_once("../config/database.php");
require_once("../models/Categorie.php");
class ServiceCategorie extends Database
{

    protected $db;
    public function addCategorie(Categorie $categorie)
    {
        $this->db = $this->connect();

        $nom_categorie = $categorie->getNomcategorie();

        $new_categorie = "INSERT INTO categorie (nomCategorie) VALUES (:nomCat)";
        $stmt = $this->db->prepare($new_categorie);
        $stmt->bindparam(":nomCat", $nom_categorie);
        $stmt->execute();
        $categorieId = $this->db->lastInsertId();
        return $categorieId;
    }
    public function selectCategories()
    {
        $this->db = $this->connect();
        $queryCategories = "SELECT * FROM categorie ";
        $query = $this->db->query($queryCategories);
    
        if ($query) {
            $categorieDB = $query->fetchAll(PDO::FETCH_ASSOC);
            $categories = array();
    
            foreach ($categorieDB as $category) {
                $categories[] = new Categorie($category["idCategorie"], $category["nomCategorie"]);
            }
    
            return $categories;
        }
    
        return null;
    }
    public function updateCategorie($currentCategoryName, $newCategoryName)
    {
        $this->db = $this->connect();
    
        $updateCategoryQuery = "UPDATE categorie SET nomCategorie = :newNomCat WHERE idCategorie = :currentNomCat";
        $stmt = $this->db->prepare($updateCategoryQuery);
        $stmt->bindParam(":newNomCat", $newCategoryName);
        $stmt->bindParam(":currentNomCat", $currentCategoryName);
    
        try {
           $update =  $stmt->execute();
            return $update;
        } catch (PDOException $th) {
            die($th->getMessage());
        }
    }
}
?>