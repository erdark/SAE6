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

print_r($type);

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
        <input type="text" id="end" name="end" value="<?= $element->min_price ?>" required><br><br>
        
        <label for="max_price">Prix maximum :</label>
        <input type="text" id="end" name="end" value="<?= $element->max_price ?>" required><br><br>

        <label for="description">Description :</label>
        <input type="text" id="end" name="end" value="<?= $element->description ?>" required><br><br>

        <label for="seats">Nombre de places:</label>
        <input type="text" id="end" name="end" value="<?= $element->seats?>" required><br><br>


    <?php elseif  ($type === 'remontees'): ?>
        <label for="debit">Débit:</label>
        <input type="text" id="end" name="end" value="<?= $element->debit?>" required><br><br>

        <label for="type_remontee">Type:</label>
        <select id="type_remontee" name="type_remontee">
            <option value="vert" <?= $element->type_remontee == 'tire-fesse' ? 'selected' : '' ?>>Tire-Fesse</option>
            <option value="bleu" <?= $element->type_remontee == 'telesiege' ? 'selected' : '' ?>>Télésiège</option>
        </select><br><br>
    <?php endif; ?>
    <input type="submit" value="Mettre à jour">
</form>

</body>
</html>
