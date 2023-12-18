<?php

require_once("../config/database.php");
require_once("../models/countPlant.php");
require_once("../models/count.php");
require_once("../models/countItems.php");

class ServiceCountItems extends Database
{
    protected $db;

  

    public function plantParCat()
    {
        $this->db = $this->connect();
        $plantCat = "SELECT
            nomCategorie,
            (SELECT COUNT(idPlante) FROM plante WHERE idCategorie = c.idCategorie) AS totalPlants
            FROM
            categorie AS c;";

        $countplant = array();
        $sqlRes = $this->db->query("$plantCat");
        $countesplntcats = $sqlRes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($countesplntcats as $countesplntcat) {
            $count = new Count($countesplntcat["totalPlants"], $countesplntcat["nomCategorie"]);
            $countplant[] = $count;
        }

        return $countplant;
    }


    public function totalPlant()
    {
        $this->db = $this->connect();
        $A = "SELECT COUNT(idPlante) AS totalplante FROM plante";
        $sqlA = $this->db->query("$A");


        $countPlant = new CountPlant($sqlA->fetch(PDO::FETCH_ASSOC)['totalplante']);

        return $countPlant;
    }

    public function totalCommand()
    {
        $this->db = $this->connect();
        $X = "SELECT COUNT(idCommande) AS totalCommand FROM commande";
        $sqlX = $this->db->query("$X");


        $countCommande = new Countcommand($sqlX->fetch(PDO::FETCH_ASSOC)['totalCommand']);

        return $countCommande;
    }
}

?>