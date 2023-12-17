<?php

require_once("../config/database.php");
require_once("../models/utilisateur.php");

class ServiceAuth extends Database
{
    protected $db;

    public function login($email)
    {
        $db = $this->connect();

        $select = "SELECT utilisateur.*, roles.nameRole
                   FROM utilisateur
                   INNER JOIN roles ON utilisateur.idRole = roles.idRole
                   WHERE utilisateur.emailUtilisateur = :email";

        $stmt = $db->prepare($select);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $stmt->execute();

        // Fetch the data
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
        
        
    }
}

?>
