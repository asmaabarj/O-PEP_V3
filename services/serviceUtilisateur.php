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
public function showUsers($email)
{
    $db = $this->connect();

    $clientsQuery = "SELECT * FROM utilisateur WHERE emailUtilisateur = :email";
    $stmt = $db->prepare($clientsQuery);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $clientsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $clients = array();
    foreach ($clientsData as $client) {
        $clients[] = new Utilisateur($client["idRole"], $client["nomUtilisateur"], $client["prénomUtilisateur"], $client["emailUtilisateur"], $client["MdpUtilisateur"]);
    }

    return $clients;
}

    public function addUser(utilisateur $utilisateur){
        $db = $this->connect();
        $lname = $utilisateur->getNomUtilisateur();
        $fname = $utilisateur->getPrénomUtilisateur();
        $email = $utilisateur->getEmailUtilisateur();
        $password = $utilisateur->getMdpUtilisateur();
        $idrole = $utilisateur->getIdrole();



        $clientsQuery = "INSERT INTO utilisateur (nomUtilisateur, prénomUtilisateur, emailUtilisateur, MdpUtilisateur, idRole)
        VALUES (:lname, :fname, :email, :password, :roleId)";
        

  $stmt = $db->prepare($clientsQuery);
  $stmt->bindparam(":lname", $lname);
  $stmt->bindparam(":fname", $fname);
  $stmt->bindparam(":email", $email);
  $stmt->bindparam(":password", $password);
  $stmt->bindparam(":roleId", $idrole);


  $stmt->execute();


    }
    public function login(utilisateur $utilisateur){
        $db = $this->connect();
        $email = $utilisateur->getEmailUtilisateur();
        $password = $utilisateur->getMdpUtilisateur();



        $select = "SELECT utilisateur.*, roles.nameRole
        FROM utilisateur
        INNER JOIN roles ON utilisateur.idRole = roles.idRole
        WHERE utilisateur.emailUtilisateur ='$email'";
        

  $stmt = $db->prepare($select);
  $stmt->bindparam(":email", $email);
  $stmt->bindparam(":password", $password);


  $stmt->execute();


    } 

}

?>