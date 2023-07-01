<?php
require "../Views/Template.php" ?>


<br><br><br><br><br><br>
<main class="main-home ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-center align-items-center mw-20 flex-column">
                <h4 class="text-primary text-uppercase text-center fw-bold pt-3 ">Ajouter une nouvelle classe</h4>
            <form action="/classe/addClasse/" method="post" class="d-flex">
                    <input type="text" name="newClasse" class="form-control mx-1" placeholder="Entrez la nouvelle classe" id="Newyear" required>
                    <button type="submit" class="btn btn-primary" id="addYear">Ajouter</button>
            </form>
            </div>
            <hr class="mt-2">
            <div class="col-sm-10 col-md-10">
                <table class="table table-bordered border-danger table-hover table-striped">
                    <caption class="text-dark text-uppercase text-center fs-1 fw-bold caption-top">
                        <strong><?php echo $niveau ?> : Listes des Classes</strong>
                    </caption>
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">Liste des classes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($classes as $value) : ?>
                            <tr>
                                <td scope="row" class="text-center d-flex justify-content-between align-items-center">
                                    <span class="text-center fs-4"> <strong><?= $value["libelle_classe"] ?></strong> </span>
                                    <div>
                                        <a href="/classe/liste/<?= $value["id_classe"]?>" type="button" class="btn btn-success fw-bold">View <i class="bi bi-eye-fill"></i></a>
                                        <a href="#" type="button" class="btn btn-primary fw-bold">Modifier <i class="bi bi-pencil-square"></i></a>
                                        <a href="/classe/delete/<?= $value["id_classe"]?>" type="button" class="btn btn-danger fw-bold">Supprimer <i class="bi bi-trash"></i></a>
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
                            