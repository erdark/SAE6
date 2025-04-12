<?php

require_once '../session.php';

foreach ($_SESSION['data']->pistes as $piste){
    if($piste->id == $_GET['id']){
        $installation_concernee = $piste;
    }
}
if(!isset($installation_concernee)){
    foreach ($_SESSION['data']->parkings as $parking){
        if($parking->id == $_GET['id']){
            $installation_concernee = $parking;
        }
    }
}

if(!isset($installation_concernee)){
    foreach ($_SESSION['data']->restaurants as $restaurant){
        if($restaurant->id == $_GET['id']){
            $installation_concernee = $restaurant;
        }
    }
}
if(!isset($installation_concernee)){
    foreach ($_SESSION['data']->remontees as $remontee){
        if($remontee->id == $_GET['id']){
            $installation_concernee = $remontee;
        }
    }
}

array_push($installation_concernee->perturbations, (object) array('start' => $_POST['start'], 'end' => $_POST['end'], 'description' => $_POST['description']));


header("Location: installation_details.php?type=" . $_GET['type']);
exit;
?>