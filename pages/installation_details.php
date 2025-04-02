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
    /* A SUPPRIMER
    $previousDate = date("2025-04-02T14:23:06Z");
    $currentDate = date("Y-m-dTH:i:sZ");
    $futurDate = date("2025-04-02T17:23:06Z");
    echo "devrait etre 1 " . ($previousDate < $currentDate) . " ";
    echo "devrait etre 1 " . ($futurDate > $currentDate) . " ";
    echo "devrait etre 0 " . ($previousDate > $currentDate) . " ";
    echo "devrait etre 0 " . ($futurDate < $currentDate) . " ";

    echo "devrait etre 1 " . ($previousDate < $currentDate && $futurDate > $currentDate) . " ";
    var_dump($currentDate);
    exit;
    return true;
    */
    
    $currentDate = date('d-m-YTH:i:sZ');
    foreach ($perturbations as $perturbation) {
        if (date($perturbation->start) < $currentDate && date($perturbation->end) > $currentDate) {
            return true;
        }
    }
    return false;
    
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
                        echo "Intitulé : $piste->name | Niveau : $piste->color | Status : " . ($piste->open ? "Ouvert" : "Fermé") . (checkPerturbations($piste->perturbations) ? "&nbsp; <img src='../images/warning.png' width='20'>" : "") . ($_SESSION["isAdmin"] ? "&nbsp;<a href='../pages/update_installation.php?type=piste&id=$piste->id'>Edit</a>" : "");
                    echo "</div>";

                    echo "<div id='bottom_div_id_$piste->id' style='display: none;'>";
                        echo "<ul>";
                            $startHour = new DateTime($piste->start);
                            $formattedHourStart = $startHour->format('H\hi');
                            $endHour = new DateTime($piste->end);
                            $formattedHourEnd = $endHour->format('H\hi');
                            echo "<li>Horaires : $formattedHourStart - $formattedHourEnd</li>";
                            echo "<li>Perturbations : ";
                                if (count($piste->perturbations) != 0) {
                                    echo "<ul>";
                                    foreach ($piste->perturbations as $perturbation) {
                                        $start = new DateTime($perturbation->start);
                                        $formattedDateStart = $start->format('d/m/Y H:i');
                                        $end = new DateTime($perturbation->end);
                                        $formattedDateEnd = $end->format('d/m/Y H:i');
                                        echo "<li>$perturbation->description (Début : $formattedDateStart | Fin : $formattedDateEnd)</li>";
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
        




        case "restaurants":
            foreach ($_SESSION['data']->restaurants as $restaurant) {
                echo "<div class='main_div'>";

                    echo "<div id='head_div_id_$restaurant->id' onClick='toggleDiv(bottom_div_id_$restaurant->id)'>";
                        echo "Intitulé : $restaurant->name | Note : $restaurant->rating/5 | Status : " . ($restaurant->open ? "Ouvert" : "Fermé") . (checkPerturbations($restaurant->perturbations) ? "&nbsp; <img src='../images/warning.png' width='20'>" : "") . ($_SESSION["isAdmin"] ? "&nbsp;<a href='../pages/update_installation.php?type=restaurant&id=$restaurant->id'>Edit</a>" : "");
                    echo "</div>";

                    echo "<div id='bottom_div_id_$restaurant->id' style='display: none;'>";
                        echo "<ul>";
                            echo "<li>Description : $restaurant->description</li>";
                            echo "<li>Prix : " . $restaurant->min_price . "€ - " . $restaurant->max_price . "€</li>";
                            $startHour = new DateTime($restaurant->start);
                            $formattedHourStart = $startHour->format('H\hi');
                            $endHour = new DateTime($restaurant->end);
                            $formattedHourEnd = $endHour->format('H\hi');
                            echo "<li>Horaires : $formattedHourStart - $formattedHourEnd</li>";
                            echo "<li>Capacités d'accueil maximum : $restaurant->seats personnes</li>";
                            echo "<li>Perturbations : ";
                                if (count($restaurant->perturbations) != 0) {
                                    echo "<ul>";
                                    foreach ($restaurant->perturbations as $perturbation) {
                                        $start = new DateTime($perturbation->start);
                                        $formattedDateStart = $start->format('d/m/Y H:i');
                                        $end = new DateTime($perturbation->end);
                                        $formattedDateEnd = $end->format('d/m/Y H:i');
                                        echo "<li>$perturbation->description (Début : $formattedDateStart | Fin : $formattedDateEnd)</li>";
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
        



        case "parkings":
            foreach ($_SESSION['data']->parkings as $parking) {
                echo "<div class='main_div'>";

                    echo "<div id='head_div_id_$parking->id' onClick='toggleDiv(bottom_div_id_$parking->id)'>";
                        echo "Intitulé : $parking->name | Prix : " . $parking->price . "€ | Nombre de places : $parking->slots | Status : " . ($parking->open ? "Ouvert" : "Fermé") . ($_SESSION["isAdmin"] ? "&nbsp;<a href='../pages/update_installation.php?type=parking&id=$parking->id'>Edit</a>" : "");
                    echo "</div>";

                    echo "<div id='bottom_div_id_$parking->id' style='display: none;'>";
                        echo "<ul>";
                            $startHour = new DateTime($parking->start);
                            $formattedHourStart = $startHour->format('H\hi');
                            $endHour = new DateTime($parking->end);
                            $formattedHourEnd = $endHour->format('H\hi');
                            echo "<li>Horaires : $formattedHourStart - $formattedHourEnd</li>";
                        echo "</ul>";
                    echo "</div>";

                echo "</div>";
            }
            break;
        




        case "remontees":
            foreach ($_SESSION['data']->remontees as $remontee) {
                echo "<div class='main_div'>";

                    echo "<div id='head_div_id_$remontee->id' onClick='toggleDiv(bottom_div_id_$remontee->id)'>";
                        echo "Intitulé : $remontee->name | Type : $remontee->type_remontee | Status : " . ($remontee->open ? "Ouvert" : "Fermé") . (checkPerturbations($remontee->perturbations) ? "&nbsp; <img src='../images/warning.png' width='20'>" : "") . ($_SESSION["isAdmin"] ? "&nbsp;<a href='../pages/update_installation.php?type=remontee&id=$remontee->id'>Edit</a>" : "");
                    echo "</div>";

                    echo "<div id='bottom_div_id_$remontee->id' style='display: none;'>";
                        echo "<ul>";
                            echo "<li>Debit : " . $remontee->debit . " personnes/min</li>";
                            $startHour = new DateTime($remontee->start);
                            $formattedHourStart = $startHour->format('H\hi');
                            $endHour = new DateTime($remontee->end);
                            $formattedHourEnd = $endHour->format('H\hi');
                            echo "<li>Horaires : $formattedHourStart - $formattedHourEnd</li>";
                            echo "<li>Perturbations : ";
                                if (count($remontee->perturbations) != 0) {
                                    echo "<ul>";
                                    foreach ($remontee->perturbations as $perturbation) {
                                        $start = new DateTime($perturbation->start);
                                        $formattedDateStart = $start->format('d/m/Y H:i');
                                        $end = new DateTime($perturbation->end);
                                        $formattedDateEnd = $end->format('d/m/Y H:i');
                                        echo "<li>$perturbation->description (Début : $formattedDateStart | Fin : $formattedDateEnd)</li>";
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
