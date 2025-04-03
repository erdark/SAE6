<?php

require_once '../session.php';


foreach ($_SESSION['data']->pistes as $piste){
    if($piste->id == $_GET['id']){
        $piste_concernee = $piste;
    }
}
var_dump($piste_concernee);
echo "<br/><br/>";

array_push($piste_concernee->perturbations, (object) array('start' => $_POST['start'], 'end' => $_POST['end'], 'description' => $_POST['description']));

var_dump($piste_concernee);
echo "<br/><br/>";
var_dump($_SESSION);
// header("Location: home.php");
// exit;
?>