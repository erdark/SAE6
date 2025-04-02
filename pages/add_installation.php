<?php
// Vérification de l'existence du paramètre 'type' dans l'URL
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Définition du formulaire en fonction du type
switch ($type) {
    case 'piste':
        // Formulaire pour "piste"
        $formFields = [
            'name' => 'Nom',
            'start' => 'Horaire de début',
            'end' => 'Horaire de fin',
            'open' => 'Ouverture',
            'color' => 'Couleur'
        ];
        break;

    case 'restaurant':
        // Formulaire pour "restaurant"
        $formFields = [
            'name' => 'Nom',
            'start' => 'Horaire de début',
            'end' => 'Horaire de fin',
            'open' => 'Ouverture',
            'min_price' => 'Prix minimum',
            'max_price' => 'Prix maximum',
            'description' => 'Description',
            'seats' => 'Nombre de places'
        ];
        break;

    case 'remontée':
        // Formulaire pour "remontée"
        $formFields = [
            'name' => 'Nom',
            'start' => 'Horaire de début',
            'end' => 'Horaire de fin',
            'open' => 'Ouverture',
            'debit' => 'Débit',
            'type_remontee' => 'Type'
        ];
        break;

    case 'parking':
        // Formulaire pour "parking"
        $formFields = [
            'name' => 'Nom',
            'start' => 'Horaire de début',
            'end' => 'Horaire de fin',
            'open' => 'Ouverture',
            'slots' => 'Nombre de place'
        ];
        break;

    default:
        $formFields = [];
        break;
}

?>

<!-- Affichage du formulaire selon le type sélectionné -->
<?php if (!empty($formFields)): ?>
    <form action="ajouter.php" method="POST">
        <h3>Ajouter un(e) <?= ucfirst($type) ?></h3>

         <!-- Champ caché pour transmettre le type -->
         <input type="hidden" name="type" value="<?= $type ?>">

        <?php foreach ($formFields as $name => $label): ?>
            <?php if ($name == 'start' || $name == 'end'): ?>
                <!-- Champs de type "time" pour l'heure -->
                <label for="<?= $name ?>"><?= $label ?>:</label>
                <input type="time" id="<?= $name ?>" name="<?= $name ?>" required><br><br>
            <?php elseif ($name == 'open'): ?>
                <!-- Champ toggle pour l'Ouverture -->
                <label for="<?= $name ?>"><?= $label ?>:</label>
                <label class="switch">
                    <input type="checkbox" id="<?= $name ?>" name="<?= $name ?>" value="true">
                    <span class="slider round"></span>
                </label>
                <br><br>
            <?php elseif ($name == 'color'): ?>
                <!-- Liste déroulante pour Couleur -->
                <label for="<?= $name ?>"><?= $label ?>:</label>
                <select id="<?= $name ?>" name="<?= $name ?>" required>
                    <option value="vert">Vert</option>
                    <option value="bleu">Bleu</option>
                    <option value="rouge">Rouge</option>
                    <option value="noir">Noir</option>
                </select>
                <br><br>
            <?php else: ?>
                <!-- Autres champs texte classiques -->
                <label for="<?= $name ?>"><?= $label ?>:</label>
                <input type="text" id="<?= $name ?>" name="<?= $name ?>" required><br><br>
            <?php endif; ?>
        <?php endforeach; ?>

        <input type="submit" value="Ajouter">
    </form>
<?php else: ?>
    <p>Aucun type sélectionné.</p>
<?php endif; ?>
