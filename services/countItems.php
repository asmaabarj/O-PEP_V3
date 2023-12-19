<?php

require_once("../config/database.php");
require_once("../models/countPlant.php");
require_once("../models/count.php");
require_once("../models/countItems.php");

class ServiceCountItems extends Database
{
    protected $db;

  

   
    


    public function totalPlantItems($id)
    {
        $this->db = $this->connect();
        $A = "SELECT COUNT(idPlante) AS totalplante FROM panier where idUtilisateur=$id";
        $sqlA = $this->db->query("$A");

      $countPlantes =  $sqlA->fetch(PDO::FETCH_ASSOC);
        $countPlant = new CountPlant($countPlantes['totalplante']);

        return $countPlant;
    }

    
}

?>