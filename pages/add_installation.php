<?php
include '../includes/header.php';

// Vérification de l'existence du paramètre 'type' dans l'URL
$typeFormatted = isset($_GET['type']) ? $_GET['type'] : '';

// Définition du formulaire en fonction du type
switch ($typeFormatted) {
    case 'pistes':
        // Formulaire pour "piste"
        $formFields = [
            'name' => 'Nom',
            'start' => 'Horaire de début',
            'end' => 'Horaire de fin',
            'open' => 'Ouverture',
            'color' => 'Couleur'
        ];
        $type = "piste";
        break;

    case 'restaurants':
        // Formulaire pour "restaurant"
        $formFields = [
            'name' => 'Nom',
            'start' => 'Horaire de début',
            'end' => 'Horaire de fin',
            'open' => 'Ouverture',
            'min_price' => 'Prix minimum',
            'max_price' => 'Prix maximum',
            'description' => 'Description',
            'seats' => 'Nombre de places',
            'rating' => 'Note'
        ];
        $type = "restaurant";
        break;

    case 'remontees':
        // Formulaire pour "remontée"
        $formFields = [
            'name' => 'Nom',
            'start' => 'Horaire de début',
            'end' => 'Horaire de fin',
            'open' => 'Ouverture',
            'debit' => 'Débit',
            'type_remontee' => 'Type'
        ];
        $type = "remontée";
        break;

    case 'parkings':
        // Formulaire pour "parking"
        $formFields = [
            'name' => 'Nom',
            'start' => 'Horaire de début',
            'end' => 'Horaire de fin',
            'open' => 'Ouverture',
            'slots' => 'Nombre de place',
            'price' => 'Prix'
        ];
        $type = "parking";
        break;

    default:
        $formFields = [];
        break;
}

?>

<!-- Affichage du formulaire selon le type sélectionné -->
<?php if (!empty($formFields)): ?>
    <div class="update-container">
        <form class="update-form" action="ajouter.php" method="POST">
            <h2>Ajouter un(e) <?= ucfirst($type) ?></h2>

            <!-- Champ caché pour transmettre le type -->
            <input type="hidden" name="type" value="<?= $type ?>">

            <?php foreach ($formFields as $name => $label): ?>
                <?php if ($name == 'start' || $name == 'end'): ?>
                    <!-- Champs de type "time" pour l'heure -->
                    <label for="<?= $name ?>"><?= $label ?>:</label>
                    <input type="time" id="<?= $name ?>" name="<?= $name ?>" required>
                <?php elseif ($name == 'open'): ?>
                    <!-- Champ toggle pour l'Ouverture -->

                <?php elseif ($name == 'color'): ?>
                    <!-- Liste déroulante pour Couleur -->
                    <label for="<?= $name ?>"><?= $label ?>:</label>
                    <select id="<?= $name ?>" name="<?= $name ?>" required>
                        <option value="vert">Vert</option>
                        <option value="bleu">Bleu</option>
                        <option value="rouge">Rouge</option>
                        <option value="noir">Noir</option>
                    </select>

                <?php elseif ($name == 'type_remontee'): ?>
                    <!-- Liste déroulante pour Couleur -->
                    <label for="<?= $name ?>"><?= $label ?>:</label>
                    <select id="<?= $name ?>" name="<?= $name ?>" required>
                        <option value="tire-fesse">Tire-Fesse</option>
                        <option value="telesiege">Télésiège</option>
                    </select>

                <?php else: ?>
                    <!-- Autres champs texte classiques -->
                    <label for="<?= $name ?>"><?= $label ?>:</label>
                    <input type="text" id="<?= $name ?>" name="<?= $name ?>" required>
                <?php endif; ?>
            <?php endforeach; ?>

            <span>
                <label for="<?= $name ?>"><?= $label ?>:</label>
                <input type="checkbox" id="<?= $name ?>" name="<?= $name ?>" value="true">
            </span>
            <input class="btn" type="submit" value="Ajouter">
        </form>
    </div>
<?php else: ?>
    <p>Aucun type sélectionné.</p>
<?php endif; ?>
<?php
include '../includes/footer.php';
?>