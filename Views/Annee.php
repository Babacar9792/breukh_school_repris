<?php

require "../Views/Template.php";


?>



<br><br><br><br><br><br>

<?php
if (isset($_SESSION["errorYear"])) {

    echo " <div class='alert alert-danger border border-4 fw-bold fs-4 text-center'>" . $_SESSION["error"] . "</div> ";
    unset($_SESSION["errorYear"]);
}
?>

<main class="main-home ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-center align-items-center mw-20 flex-column">
                <h4 class="text-primary text-uppercase text-center fw-bold pt-3 ">Ajouter une nouvelle année scolaire</h4>
                <form action="/Annee/addYear/" method="post" class="d-flex">
                    <input type="text" name="nouvelleAnnee" class="form-control mx-1" placeholder="Entrez la nouvelle année scolaire" id="Newyear" required>
                    <button type="submit" class="btn btn-primary" id="addYear">Ajouter</button>
                </form>
            </div>
            <hr class="mt-2">
            <div class="col-sm-10 col-md-10">
                <table class="table table-bordered border-danger table-hover">
                    <caption class="text-dark text-uppercase text-center fs-1 fw-bold caption-top">
                        <strong>Liste des Années scolaires</strong>
                    </caption>
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">Annee scolaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($years as $value) : ?>
                            <tr>
                                <td scope="row" class="text-center d-flex justify-content-between align-items-center">
                                    <span class="text-center fs-4"> <strong><?= $value["libelle"] ?></strong> </span>
                                    <div>
                                        <a href="/Annee/UpdateStatut/<?= $value["id_annee"] ?>" type="button" class="btn btn-success fw-bold">Activer <i class="bi bi-power"></i></a>
                                        <a href="/Annee/update/<?= $value["id_annee"] ?>" type="button" class="btn btn-primary fw-bold">Modifier <i class="bi bi-pencil-square"></i></a>
                                        <a href="/Annee/deleteYear/<?= $value["id_annee"] ?>" type="button" class="btn btn-danger fw-bold">Supprimer <i class="bi bi-trash"></i></a>
                                    </div>

                                </td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
</main>

<script src="/DossierJS/Annee.js"></script>