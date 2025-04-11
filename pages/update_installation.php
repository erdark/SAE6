<?php
session_start();

// Vérifier si le type et l'ID sont passés dans l'URL
if (!isset($_GET['type']) || !isset($_GET['id'])) {
    die("Type ou ID manquant.");
}

$type = $_GET['type']; // Ex: "piste"
$id = $_GET['id'];     // Ex: "1"

// Normaliser le type (ajouter "s" et enlever les accents si nécessaire)
function normalizeType($type) {
    $type = iconv('UTF-8', 'ASCII//TRANSLIT', $type);
    $type = str_replace(["'", "`"], "", $type);
    return lcfirst($type) ;
}

$type = normalizeType($type);

// Vérifier si les données sont disponibles en session
if (!isset($_SESSION['data']) || !isset($_SESSION['data']->$type)) {
    die("Les données ne sont pas disponibles en session.");
}

// Rechercher l'élément à modifier
$element = null;
foreach ($_SESSION['data']->$type as $item) {
    if ($item->id == $id) {
        $element = $item;
        break;
    }
}

if (!$element) {
    die("Élément non trouvé.");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier <?= ucfirst($type) ?></title>
</head>
<body>

<h2>Modifier <?= ucfirst($type) ?> (ID: <?= $id ?>)</h2>

<form action="save_update.php" method="POST">
    <input type="hidden" name="type" value="<?= $type ?>">
    <input type="hidden" name="id" value="<?= $id ?>">

    <label for="name">Nom:</label>
    <input type="text" id="name" name="name" value="<?= $element->name ?>" required><br><br>

    <label for="start">Horaire de début:</label>
    <input type="time" id="start" name="start" value="<?= $element->start ?>" required><br><br>

    <label for="end">Horaire de fin:</label>
    <input type="time" id="end" name="end" value="<?= $element->end ?>" required><br><br>

    <label for="open">Ouvert:</label>
    <input type="checkbox" id="open" name="open" <?= $element->open ? 'checked' : '' ?>><br><br>

    <?php if ($type === 'pistes'): ?>
        <label for="color">Couleur:</label>
        <select id="color" name="color">
            <option value="vert" <?= $element->color == 'vert' ? 'selected' : '' ?>>Vert</option>
            <option value="bleu" <?= $element->color == 'bleu' ? 'selected' : '' ?>>Bleu</option>
            <option value="rouge" <?= $element->color == 'rouge' ? 'selected' : '' ?>>Rouge</option>
            <option value="noir" <?= $element->color == 'noir' ? 'selected' : '' ?>>Noir</option>
        </select><br><br>

    <?php elseif ($type === 'restaurants'): ?>
        <label for="min_price">Prix minimum :</label>
        <input type="text" id="min_price" name="min_price" value="<?= $element->min_price ?>" required><br><br>
        
        <label for="max_price">Prix maximum :</label>
        <input type="text" id="max_price" name="max_price" value="<?= $element->max_price ?>" required><br><br>

        <label for="description">Description :</label>
        <input type="text" id="description" name="description" value="<?= $element->description ?>" required><br><br>

        <label for="seats">Nombre de places:</label>
        <input type="text" id="seats" name="seats" value="<?= $element->seats?>" required><br><br>

        
        <label for="rating">Note:</label>
        <input type="text" id="rating" name="rating" value="<?= $element->rating?>" required><br><br>

        <?php if (!empty($element->perturbations)) : ?>
    <h3>Modifier les Perturbations :</h3>
    <?php foreach ($element->perturbations as $index => $perturbation) : ?>
        <fieldset>
            <legend>Perturbation <?= $index + 1 ?></legend>
            
            <label for="perturbation_start_<?= $index ?>">Début :</label>
            <input type="datetime-local" id="perturbation_start_<?= $index ?>" name="perturbations[<?= $index ?>][start]" 
                   value="<?= date('Y-m-d\TH:i', strtotime($perturbation->start)) ?>"><br><br>

            <label for="perturbation_end_<?= $index ?>">Fin :</label>
            <input type="datetime-local" id="perturbation_end_<?= $index ?>" name="perturbations[<?= $index ?>][end]" 
                   value="<?= date('Y-m-d\TH:i', strtotime($perturbation->end)) ?>"><br><br>

            <label for="perturbation_description_<?= $index ?>">Description :</label>
            <input type="text" id="perturbation_description_<?= $index ?>" name="perturbations[<?= $index ?>][description]" 
                   value="<?= htmlspecialchars($perturbation->description) ?>"><br><br>

            <!-- Bouton de suppression -->
            <button type="button" onclick="supprimerPerturbation(<?= $index ?>)">🗑️ Supprimer</button>
        </fieldset>
    <?php endforeach; ?>
<?php else : ?>
    <p>Aucune perturbation enregistrée.</p>
<?php endif; ?>



    <?php elseif  ($type === 'remontees'): ?>
        <label for="debit">Débit:</label>
        <input type="text" id="debit" name="debit" value="<?= $element->debit?>" required><br><br>

        <label for="type_remontee">Type:</label>
        <select id="type_remontee" name="type_remontee">
            <option value="tire-fesse" <?= $element->type_remontee == 'tire-fesse' ? 'selected' : '' ?>>Tire-Fesse</option>
            <option value="telesiege" <?= $element->type_remontee == 'telesiege' ? 'selected' : '' ?>>Télésiège</option>
        </select><br><br>
    <?php elseif  ($type === 'parkings'): ?>
        <label for="slots">Nombre de place:</label>
        <input type="text" id="slots" name="slots" value="<?= $element->slots?>" required><br><br>

        <label for="price">Prix:</label>
        <input type="text" id="price" name="price" value="<?= $element->price?>" required><br><br>

    <?php endif; ?>
    <input type="submit" value="Mettre à jour">
</form>

</body>
</html>
