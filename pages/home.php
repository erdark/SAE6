<?php
require_once '../session.php';
include '../includes/header.php';

echo "<h1>Liste des éléments</h1>";

if (!empty($_SESSION['data'])) {
    echo "<ul>";

    //print_r($_SESSION['data']->piste);

    foreach ($_SESSION['data']->pistes as $piste) {
        //print "<pre>";
        //print_r($piste);
        //print "</pre>";
        
        echo "<li>$piste->name</li>";
    }
    /* foreach ($_SESSION['data'] as $index => $item) {
        echo "<li>$item <a href='delete.php?index=$index'>❌ Supprimer</a></li>";
    } */
    echo "</ul>";
} else {
    echo "<p>Aucun élément enregistré.</p>";
}

include '../includes/footer.php';
?>