<?php
require_once '../session.php';
include '../includes/header.php';

?>

<h1>Installations de (nom de la station)</h1>

<div class="container">
    <div class="cards">
        <article class="card">
            <a href="./installation_details.php?type=pistes">
                <img
                src="../images/piste.png"
                alt="Pictogramme d'une piste" />
                <div class="content">
                    <p>Pistes</p>
                </div>
            </a>
        </article>

        <article class="card">
            <a href="./installation_details.php?type=restaurants">
                <img
                src="../images/repas.png"
                alt="Pictogramme d'un repas" />
                <div class="content">
                    <p>Restaurants</p>
                </div>
            </a>
        </article>

        <article class="card">
            <a href="./installation_details.php?type=parkings">
                <img
                src="../images/parking.png"
                alt="Pictogramme d'un parking" />
                <div class="content">
                    <p>Parkings</p>
                </div>
            </a>
        </article>

        <article class="card">
            <a href="./installation_details.php?type=remontees">
                <img
                src="../images/remontee.png"
                alt="Pictogramme d'une remontée mécanique" />
                <div class="content">
                    <p>Remontées Mécaniques</p>
                </div>
            </a>
        </article>

        <article class="card">
            <a href="./map.php">
                <img
                src="../images/carte.png"
                alt="Pictogramme d'une carte" />
                <div class="content">
                    <p>Carte</p>
                </div>
            </a>
        </article>

        <article class="card">
            <a href="./activites.php">
            <img
            src="../images/activites.png"
            alt="Pictogramme d'activites" />
            <div class="content">
                <p>Activités</p>
            </div>
        </article>
        

    </div>
</div>

<?php
include '../includes/footer.php';

?>