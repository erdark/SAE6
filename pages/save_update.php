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

            if($type === 'restaurants'){
                $item->min_price = $_POST['min_price'];
                $item->max_price = $_POST['max_price'];
                $item->description = $_POST['description'];
                $item->seats = $_POST['seats'];
                $item->rating = $_POST['rating'];
            }

            if($type === 'remontees'){
                $item->debit = $_POST['debit'];
                $item->type_remontee = $_POST['type_remontee'];
            }

            if($type === 'parkings'){
                $item->slots = $_POST['slots'];
                $item->price = $_POST['price'];
            }

            // 🧹 Mise à jour des perturbations (filtrage des suppressions)
            if (isset($_POST['perturbations']) && is_array($_POST['perturbations'])) {
                $perturbations = [];

                foreach ($_POST['perturbations'] as $p) {
                    if (!isset($p['delete'])) {
                        $perturbations[] = (object)[
                            'start' => $p['start'],
                            'end' => $p['end'],
                            'description' => $p['description']
                        ];
                    }
                }

                $item->perturbations = $perturbations;
            }

            break;
        }
    }

    // Redirection après mise à jour
    header("Location: installation_details.php?type=$type");
    exit;
}
?>
