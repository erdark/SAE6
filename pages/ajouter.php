<?php

require_once '../session.php';

// Fonction pour ajouter un nouvel élément dans la session
function ajouterDonnees($type, $data) {

    
    
    // Vérifier si les données sont en session
    if (!isset($_SESSION['data'])) {
        echo "Les données ne sont pas disponibles en session.";
        return;
    }

    // Récupérer les données depuis la session
    $jsonData = $_SESSION['data'];

    // Vérifier si le type existe dans les données
    if (isset($jsonData->$type)) {
        // Ajouter l'élément au tableau correspondant au type
        $jsonData->$type[] = $data;

        // Mettre à jour les données de la session
        $_SESSION['data'] = $jsonData;

        echo "L'élément a été ajouté avec succès.";
    } else {
        echo "Type inconnu.";
    }
    print_r($_SESSION['data']->$type);
}

// Fonction pour récupérer le dernier ID du type et l'incrémenter
function getNextId($type) {
    if (!isset($_SESSION['data']->$type) || empty($_SESSION['data']->$type)) { 
        return 1; // Si la catégorie est vide, on commence par l'ID 1
    }
    // Récupérer le dernier ID en parcourant la liste
    $lastItem = end($_SESSION['data']->$type); // Dernier élément de la liste
    
    return intval($lastItem->id) + 1; // Incrémentation de l'ID
}

function normalizeType($type) {
    // Supprimer les accents et convertir les caractères spéciaux
    $type = iconv('UTF-8', 'ASCII//TRANSLIT', $type);
    
    // Nettoyer les caractères indésirables (comme les apostrophes)
    $type = str_replace(["'", "`"], "", $type);
    
    // Mettre la première lettre en minuscule
    $type = lcfirst($type);
    
    // Ajouter un "s" à la fin pour respecter la structure de ton JSON
    return $type . 's';
}


// Vérification si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le type depuis le champ caché
    

    $type = normalizeType($_POST['type']);
    

    // Générer automatiquement le prochain ID
    $nextId = getNextId($type);

    // Création de l'objet pour stocker les données
    $data = new stdClass();
    $data->id = $nextId;
    $data->name = $_POST['name'];
    $data->start = $_POST['start'];
    $data->end = $_POST['end'];
    $data->open = isset($_POST['open']) ? $_POST['open'] == 'true' : 0;

    // Ajout des champs spécifiques selon le type
    switch ($type) {
        case 'pistes':
            $data->color = $_POST['color'];
            $data->pertubations = new stdClass();
            break;

        case 'restaurants':
            $data->min_price = $_POST['min_price'];
            $data->max_price = $_POST['max_price'];
            $data->description = $_POST['description'];
            $data->seats = $_POST['seats'];
            $data->pertubations = new stdClass();
            break;

        case 'remontees':
            $data->debit = $_POST['debit'];
            $data->type_remontee = $_POST['type_remontee'];
            $data->perturbations = new stdClass();
            
            break;

        case 'parkings':
            $data->slots = $_POST['slots'];
            $data->price = $_POST['price'];
            $data->pertubations = new stdClass();
            break;
    }

    // Appeler la fonction pour ajouter les données dans la session
    ajouterDonnees($type, $data);

    

    // Redirection après ajout
    header("Location: installation_details.php?type=$type");
    exit;
}


?>
