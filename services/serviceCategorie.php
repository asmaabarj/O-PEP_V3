<?php
require_once("../config/database.php");

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
                // Use an associative array to pair category name with category ID
                $categories[] = array(
                    'idCategorie' => $category["idCategorie"],
                    'nomCategorie' => $category["nomCategorie"]
                );
            }
    
            return $categories;
        }
    
        return null;
    }
    public function updateCategorie($currentCategoryName, $newCategoryName)
    {
        $this->db = $this->connect();
    
        $updateCategoryQuery = "UPDATE categorie SET nomCategorie = :newNomCat WHERE nomCategorie = :currentNomCat";
        $stmt = $this->db->prepare($updateCategoryQuery);
        $stmt->bindParam(":newNomCat", $newCategoryName);
        $stmt->bindParam(":currentNomCat", $currentCategoryName);
    
        try {
            $stmt->execute();
            $affectedRows = $stmt->rowCount();
            return $affectedRows;
        } catch (PDOException $th) {
            die($th->getMessage());
        }
    }
    // public function getPlanteCategorie(){

    //    $db = $this->connect();
    //     $queryId = "SELECT idCategorie ,nomCategorie FROM categorie";
    //     $getcatgorie = $db->query($queryId);
    //     $result = $getcatgorie->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;

    // }
}
?>