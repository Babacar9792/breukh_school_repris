<?php 
    require "../Views/Template.php";?>



<br><br><br><br>
<br><br><br><br>

<main class="main-home">
    <div class="container mt-3">
        <div class="row justify-content mt-4 ">
            <div class="col-sm-10 mt-3 ">
                <table class="table table-bordered table-hover mt-3">
                    <caption class="text-primary text-uppercase text-center fs-1 fw-bold caption-top">
                        <strong>Les disciplines de la classe de  <a class="text-dark" href="http://localhost:8000/classe/liste/<?php echo $maClasse[0]['id_classe']?>"><?php echo $maClasse[0]["libelle_classe"] ?> </a> <span><input type="hidden" name="" value="" id="CurrentClasse"></span>  </strong>
                    </caption>
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">Discipline</th>
                            <th scope="col">Rescources</th>
                            <th scope="col">Examen</th>
                            <th scope="col">--</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach ($discipline as $value): ?>
                            <tr>
                            
                                <td>    <?php echo $value["libelle_discipline"]?>
                                        <input type="hidden" name="" value="<?= $value["id_dis"]?>" class="diogs" >
                                </td>
                                <td>    <input type="number" name="" id="noteressource_<?= $value["id_dis"]  ?>"   class="input" value="<?php echo $value["noteressource"]?>"  data-type = "ressource" > </td>
                                <td>    <input type="number" name="" id="noteExamen_<?= $value["id_dis"] ?>" value="<?php echo $value["noteExamen"]?>"  data-type = "examen" class="examen" > </td>
                                <td> <i class="bi bi-backspace" iddiscipline = "<?= $value["id_dis"]?>"></i>    </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                </table>
               <div class="w-100 d-flex justify-content-center"> <button  class="bg-success text-light rounded-3 px-4 py-2" id="mettreAjour">Mettre à jour</button></div>
               <div class="p-3 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 reussi d-none"></div>
            </div>
        </div>
    </div>
</main>
<script src="<?= '/DossierJS/Coefficient.js' ?>"></script>
