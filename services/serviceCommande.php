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

    
  

}

?>