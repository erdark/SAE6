<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $id = $_POST['id'];

    if (!isset($_SESSION['data']) || !isset($_SESSION['data']->$type)) {
        die("Les données ne sont pas disponibles en session.");
    }

    // Trouver et modifier l'élément
    foreach ($_SESSION['data']->$type as &$item) {
        if ($item->id == $id) {
            $item->name = $_POST['name'];
            $item->start = $_POST['start'];
            $item->end = $_POST['end'];
            $item->open = isset($_POST['open']);

            if ($type === 'pistes') {
                $item->color = $_POST['color'];
            }

            break;
        }
    }

    // Redirection après mise à jour
    header("Location: update_installation.php?type=$type&id=$id&success=1");
    exit;
}
?>
