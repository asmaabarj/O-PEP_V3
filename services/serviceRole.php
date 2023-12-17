<?php

require_once("../config/database.php");
require_once("../models/Roles.php");


class ServiceRole extends Database
{
    protected $db;

    public function selectIdRole($role)
{
    $db = $this->connect();

    $roleSelect = "SELECT idRole FROM roles WHERE nameRole = :role";
    
    $stmt = $db->prepare($roleSelect);
    
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    
    $stmt->execute();
    
    $roleRow = $stmt->fetch(PDO::FETCH_ASSOC);
    
   
        $roleId = $roleRow['idRole'];
        return $roleId;
   

    
}

    
  

}

?>