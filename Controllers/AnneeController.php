<?php

namespace Controllers;

use Model\AnneeModel;

session_start();
// require "../Controller/AnneeModel.php";
class AnneeController
{
    private $model;
    public function __construct()
    {
        $this->model = new AnneeModel();
    }
    public function getAllYear()
    {
        var_dump($this->model->Allyear());
    }
    public function Annee()
    {
        $currentYear = $this->model->getYear(1);
        $years = $this->model->getYear(0);
        require "../Views/Annee.php";
    }
    public function UpdateStatut($id)
    {
        $idCurrentYear = $this->model->getYear(1)[0]["id_annee"];
        $this->model->updateStatutYear("annee", "statut", $idCurrentYear, 0, "id_annee");
        $this->model->updateStatutYear("annee", "statut", $id, 1, "id_annee");
        $this->Annee();
    }
    public function deleteYear($id)
    {
        
        $this->model->delete("annee", $id, "id_annee");
        header("Location: http://localhost:8000/Annee/Annee/");
        // $this->Annee();
    }
    public function addYear()
    {

        if (isset($_POST["nouvelleAnnee"]) && $_POST["nouvelleAnnee"]) {

            $post = $_POST["nouvelleAnnee"];
            $num = count($this->model->searchYear($post));
            $year = explode("-", $post);
            if ($year[1] - $year[0] != 1) {
                // echo "format date incorrecte ";
                $_SESSION["errorYear"] = "format date incorrecte";
                header("Location: http://localhost:8000/Annee/Annee/");
                return;
            } else {

                if ($num === 0) {
                    $this->model->addYear($post);
                    $id = $this->model->searchYear($post)[0]["id_annee"];
                } else {
                    $id = $this->model->searchYear($post)[0]["id_annee"];
                    $this->model->updateStatutYear("annee", "archive", $id, 0, "id_annee");
                }
                $this->UpdateStatut($id);
            }
        }
    }
}
