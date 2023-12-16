<?php
require("../config/database.php");

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
    }
    public function selectcategories()
    {
        $this->db = $this->connect();
        $querycategorie = "SELECT * FROM categorie ";
        $query = $this->db->query($querycategorie);
        if ($query) {
            $categorieDB = $query->fetchAll(PDO::FETCH_ASSOC);
            $categories = array();
            foreach ($categorieDB as $categori) {
                $categories[] = new Categorie($categori["nomCategorie"]);
            }
            return $categories;
        }
        return null;
    }
}
?>