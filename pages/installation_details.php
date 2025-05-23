<?php
require_once '../session.php';
include '../includes/header.php';

$typeFormatted = htmlspecialchars($_GET["type"]);

switch ($typeFormatted) {
    case "pistes":
        $type = "pistes";
        break;
    case "restaurants":
        $type = "restaurants";
        break;
    case "parkings":
        $type = "parkings";
        break;
    case "remontees":
        $type = "remontees";
        break;
}

function checkPerturbations($perturbations)
{
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
    echo "<a class='add_btn' href='../pages/add_installation.php?type=$typeFormatted'><img class='plus' src='../images/add_btn.png'></a>";
    ?>

</div>

<div class="container">
    <?php
    switch ($type) {
        case "pistes":
            foreach ($_SESSION['data']->pistes as $piste) {
                echo "<div class='main_div'>";

                echo "<div id='head_div_id_$piste->id' onClick='toggleDiv(bottom_div_id_$piste->id)'>";
                echo "Intitulé : $piste->name | Niveau : $piste->color | " . ($piste->open ? "Ouvert" : "Fermé") . (checkPerturbations($piste->perturbations) ? "&nbsp; <img src='../images/warning.png' width='30'>" : "") . ($_SESSION["isAdmin"] ? "&nbsp;<a href='../pages/update_installation.php?type=pistes&id=$piste->id'>Edit</a>" . "&nbsp;<a href='../pages/add_perturbation.php?type=pistes&id=$piste->id'>Diffuser une pertubation</a>" : "");
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
                echo "Intitulé : $restaurant->name | Note : $restaurant->rating/5 | " . ($restaurant->open ? "Ouvert" : "Fermé") . (checkPerturbations($restaurant->perturbations) ? "&nbsp; <img src='../images/warning.png' width='30'>" : "") . ($_SESSION["isAdmin"] ? "&nbsp;<a href='../pages/update_installation.php?type=restaurants&id=$restaurant->id'>Edit</a>" . "&nbsp;<a href='../pages/add_perturbation.php?type=restaurants&id=$restaurant->id'>Diffuser une pertubation</a>" : "");
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
                echo "<li>Capacité d'accueil maximum : $restaurant->seats personnes</li>";
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
                echo "Intitulé : $parking->name | Prix : " . $parking->price . "€ | Nombre de places : $parking->slots | " . ($parking->open ? "Ouvert" : "Fermé") . (checkPerturbations($parking->perturbations) ? "&nbsp; <img src='../images/warning.png' width='30'>" : "") . ($_SESSION["isAdmin"] ? "&nbsp;<a href='../pages/update_installation.php?type=parkings&id=$parking->id'>Edit</a>" . "&nbsp;<a href='../pages/add_perturbation.php?type=parkings&id=$parking->id'>Diffuser une pertubation</a>" : "");
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
                echo "Intitulé : $remontee->name | Type : $remontee->type_remontee | " . ($remontee->open ? "Ouvert" : "Fermé") . (checkPerturbations($remontee->perturbations) ? "&nbsp; <img src='../images/warning.png' width='30'>" : "") . ($_SESSION["isAdmin"] ? "&nbsp;<a href='../pages/update_installation.php?type=remontees&id=$remontee->id'>Edit</a>" . "&nbsp;<a href='../pages/add_perturbation.php?type=remontees&id=$remontee->id'>Diffuser une pertubation</a>" : "");
                echo "</div>";

                echo "<div id='bottom_div_id_$remontee->id' style='display: none;'>";
                echo "<ul>";
                echo "<li>Debit : " . $remontee->debit . " personne/min</li>";
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
<!-- <div class="footer"> -->
    <?php include '../includes/footer.php'; ?>
<!-- </div> -->