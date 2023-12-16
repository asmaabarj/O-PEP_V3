<?php

require_once("../config/database.php");
require_once("../models/utilisateur.php");


class ServiceUtilisateur extends Database
{
    protected $db;

    public function showClients()
{
    $this->db = $this->connect();

    $clientsQuery = "SELECT * FROM utilisateur WHERE idRole = 2";
    $stmt = $this->db->query($clientsQuery);
    $clientsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
   

    $clients = array();
    foreach ($clientsData as $client) {
        $clients[] = new Utilisateur($client["idRole"], $client["nomUtilisateur"], $client["prénomUtilisateur"], $client["emailUtilisateur"], $client["MdpUtilisateur"]);
    }

    return $clients;
}

    
  

}

?>