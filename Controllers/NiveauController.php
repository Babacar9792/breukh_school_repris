<?php

namespace Controllers;

use Model\NiveauModel;

session_start();

class NiveauController
{
    private $model;
    public function __construct()
    {
        $this->model = new NiveauModel();
    }
    public function Niveau()
    {
        $currentYear = $this->model->getYear(1);
        $years = $this->model->getYear(0);
        $niveau = $this->model->AllNiveau($currentYear[0]["id_annee"]);
        require "../Views/niveau.php";
        // var_dump($this->model->AllNiveau($currentYear[0]["id_annee"]));
    }
    public function delete($id)
    {
        $this->model->delete("GroupeNiveau", $id, "id_GNiveau");
        // $currentYear = $this->model->getYear(1)[0]["id_annee"];
        header("Location: http://localhost:8000/niveau/");
    }
    public function addLevel()
    {
        if (isset($_POST["newLevel"]) && $_POST["newLevel"]) {
            $libelle = $_POST["newLevel"];
            $currentYear = $this->model->getYear(1);
            $num = count($this->model->searchLevel($currentYear[0]["id_annee"], $libelle));
            if ($num !== 0) {
                $id_ref = $this->model->searchLevel($currentYear[0]["id_annee"], $libelle)[0]["id_GNiveau"];
                var_dump($id_ref);
                $this->model->updateStatutYear("GroupeNiveau", "archive", $id_ref, 0, "id_GNiveau");
            } else {
                $this->model->addLevel($libelle, $currentYear[0]["id_annee"]);
            }
            header("Location: http://localhost:8000/niveau/");
        }
    }
    public function classe($id)
    {
        $classes = $this->model->allClasse($id);
        $currentYear = $this->model->getYear(1);
        $years = $this->model->getYear(0);
        $niveau = $this->model->getCurrentLevel($id);
        // var_dump($niveau);
        $_SESSION["currentLevel"] = $id;
        require "../Views/Classe.php";
    }

    
}
