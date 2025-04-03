<script>
    function test() {
        alert("test");
    }
</script>

<?php
require_once '../session.php';
include '../includes/header.php';

echo '<button onclick="test()">Devenir admin</button>';

echo "<h1>Fréquentation des installations de ...(nom de la station)</h1>";

if (!empty($_SESSION['data'])) {
    //print "<pre>";
    //print_r($piste);
    //print "</pre>";

    echo "<h2>Pistes</h2>";
    foreach ($_SESSION['data']->pistes as $piste) {
        echo "Nom : $piste->name";
        echo "&nbsp;";
        echo "Niveau : $piste->color";
        echo "<br>";
    }

    echo "<h2>Restaurants</h2>";
    foreach ($_SESSION['data']->restaurants as $restaurant) {
        echo "Nom : $restaurant->name";
        echo "<br>";
    }

    echo "<h2>Parkings</h2>";
    foreach ($_SESSION['data']->parkings as $parking) {
        if ($_SESSION['isAdmin']) {
            echo "Nom : $parking->name" . "<a href='delete.php?index=$parking->id'>❌ Supprimer</a>";
        } else {
            echo "Nom : $parking->name";
        }
        echo "<br>";
    }

    echo "<h2>Tire-fesses</h2>";
    foreach ($_SESSION['data']->tire_fesses as $tire_fesse) {
        if ($_SESSION['isAdmin']) {
            echo "Nom : $tire_fesse->name" . "<a href='delete.php?index=$tire_fesse->id'>❌ Supprimer</a>";
        } else {
            echo "Nom : $tire_fesse->name";
        }
        
        echo "<br>";
    }

} else {
    echo "<p>Aucun élément enregistré.</p>";
}

include '../includes/footer.php';
var_dump($_SESSION)
?>
<a href="http://localhost:8000/pages/add_perturbation.php?id=1">Ajouter une perturbation</a>
