<?php
require_once '../session.php';
include '../includes/header.php';

$typeFormatted = htmlspecialchars($_GET["type"]);

switch ($typeFormatted) {
    case "Pistes":
        $type = "pistes";
        break;
    case "Restaurants":
        $type = "restaurants";
        break;
    case "Parkings":
        $type = "parkings";
        break;
    case "Remontées":
        $type = "remontees";
        break;
}   

function checkPerturbations($perturbations) {
    return true;
}

?>

<div class="top">
        <?php
            echo "<h1>Liste des $typeFormatted</h1>";
            echo "<a class='add_btn' href='/pages/add_installation.php?type=$typeFormatted'><img src='../images/add_btn.svg'></a>";
        ?>
        
</div>

<div class="container">
    <?php
    switch ($type) {
        case "pistes":
            foreach ($_SESSION['data']->pistes as $piste) {
                echo "<div class='main_div'>";

                    echo "<div id='head_div_id_$piste->id' onClick='toggleDiv(bottom_div_id_$piste->id)'>";
                        echo "Intitulé : $piste->name | Niveau : $piste->color | Status : " . ($piste->open ? "Ouvert" : "Fermé") . (checkPerturbations($piste->perturbations) ? "&nbsp; <img src='../images/warning.png' width='20'>" : "") . "<a href='../pages/update_installation.php?type=piste&id=$piste->id'>Edit</a>";
                    echo "</div>";

                    echo "<div id='bottom_div_id_$piste->id' style='display: none;'>";
                        echo "<ul>";
                        echo "<li>Horaires : $piste->start - $piste->end</li>";
                        echo "<li>Perturbations : ";
                                if (count($piste->perturbations) != 0) {
                                    echo "<ul>";
                                    foreach ($piste->perturbations as $perturbation) {
                                        echo "<li>$perturbation->description ($perturbation->start)</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo "Aucune perturbation";
                                }
                        echo "</li>";
                        echo "</ul>";
                    echo "</div>";

                echo "</div>";
            }
            break;
    }
    

    ?>

</div>

<script>
function toggleDiv(element) {
    if (element.style.display != "none") {
        element.style.display = "none";
    } else {
        element.style.display = "block";
    }

}
</script>

<?php
include '../includes/footer.php';
?>
