<?php
require "../Views/Template.php" ?>


<br><br><br><br><br><br>
<main class="main-home ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-center align-items-center mw-20 flex-column">
                <h4 class="text-primary text-uppercase text-center fw-bold pt-3 ">Ajouter un niveau</h4>
            <form action="/niveau/addlevel/" method="post" class="d-flex">
                    <input type="text" name="newLevel" class="form-control mx-1" placeholder="Entrez un niveau" id="Newyear" required>
                    <button type="submit" class="btn btn-primary" id="addYear">Ajouter</button>
            </form>
            </div>
            <hr class="mt-2">
            <div class="col-sm-10 col-md-10">
                <table class="table table-bordered border-danger table-hover">
                    <caption class="text-dark text-uppercase text-center fs-1 fw-bold caption-top">
                        <strong>Liste des Niveaux</strong>
                    </caption>
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">Niveaux</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($niveau as $value) : ?>
                            <tr>
                                <td scope="row" class="text-center d-flex justify-content-between align-items-center">
                                    <span class="text-center fs-4"> <strong><?= $value["libelleGN"] ?></strong> </span>
                                    <div>
                                        <a href="/niveau/classe/<?= $value["id_GNiveau"]?>" type="button" class="btn btn-success fw-bold">View <i class="bi bi-power"></i></a>
                                        <a href="#" type="button" class="btn btn-primary fw-bold">Modifier <i class="bi bi-pencil-square"></i></a>
                                        <a href="/niveau/delete/<?= $value["id_GNiveau"]?>" type="button" class="btn btn-danger fw-bold">Supprimer <i class="bi bi-trash"></i></a>
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
                            