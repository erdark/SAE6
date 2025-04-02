<?php

session_start();
session_destroy();

// Initialisation du tableau en session si non défini

$_SESSION['isAdmin'] = true;

if (!isset($_SESSION['data'])) {
    $jsonobj = file_get_contents("../example.json");
        
    $_SESSION['data'] = json_decode($jsonobj);
}
?>