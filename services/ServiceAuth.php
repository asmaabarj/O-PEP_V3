<?php

require_once("../config/database.php");
require_once("../models/utilisateur.php");

class ServiceAuth extends Database
{
    protected $db;

    public function login(utilisateur $utilisateur)
    {
        $this->db = $this->connect();

        $email = $utilisateur->getEmailUtilisateur();
        $password = $utilisateur->getMdpUtilisateur();

        $select = "SELECT utilisateur.*, roles.nameRole
                   FROM utilisateur
                   INNER JOIN roles ON utilisateur.idRole = roles.idRole
                   WHERE utilisateur.emailUtilisateur = :email";

        $stmt = $this->db->prepare($select);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['MdpUtilisateur'])) {
            return [
                'user_type' => strtolower($row['nameRole']),
                'idUtilisateur' => $row['idUtilisateur']
            ];
        } else {
            return false;
        }
    }
}
?>
