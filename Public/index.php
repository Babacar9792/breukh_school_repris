<?php
$port = "http://localhost:8000";
require "../vendor/autoload.php";

use Router\Router;
// use Controllers\DisciplineController;
// $dsic = new DisciplineController();

// var_dump($dsic->genereCode("anaconda"));

$route = new Router();

    // $chaine = "modou va au marché";
    // $chaine = explode(" ", $chaine);
    // $code = "";
    // for ($i=0; $i < count($chaine); $i++) { 
    //     # code...
    //     $code = $code.$chaine[$i][0];
        
    // }
    // var_dump($code);
    // var_dump(substr($chaine,0, 2+2));

// use Model\ConnexionDb;

// $c = new ConnexionDb;
 /* if (isset($_POST["newLevel"]) && $_POST["newLevel"]) {
            $libelle = $_POST["newLevel"];
            $currentYear = $this->model->getYear(1);
            $num = count($this->model->searchLevel($currentYear, $libelle));
            if ($num !== 0) {
                $this->model->updateStatutYear("GroupeNiveau", "archive", $currentYear, 0);
            } else {
                $this->model->addLevel($libelle, $currentYear);
            }
        } */