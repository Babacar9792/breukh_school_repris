<?php

namespace Controllers;

use Model\ClasseModel;

session_start();

class ClasseController
{
    private $model;
    public function __construct()
    {
        $this->model = new ClasseModel();
    }
    public function liste($id)
    {
        // var_dump($id);   
        $currentYear = $this->model->getYear(1);
        $years = $this->model->getYear(0);
        $maClasse = $this->model->getLibelleByName("classe", "id_classe", $id);
        $student = $this->model->allStudent($id);
        // $level = $_SESSION["currentLevel"];
        $discipline = $this->model->selectAlldiscipline($id);
        $effectif  = $this->model->CountClasse("inscription", "id_classe_inscription",$id);
        $semestres = $this->model->CountClasse("semestreNiveau", "id_Gniveau_association", $maClasse[0]["id_classe_GN"]);
        require "../Views/Eleve.php";
        // var_dump($_SESSION["currentLevel"]); 
    }

    public function delete($id)
    {
        $this->model->delete("classe", $id, "id_classe");
        $level = $_SESSION["currentLevel"];
        header("Location: http://localhost:8000/niveau/classe/".$level);
    }


    public function addClasse()
    {
            if (isset($_POST["newClasse"]) && $_POST["newClasse"]) {
            $clas = $_POST["newClasse"];
            $groupeNiveau = $_SESSION["currentLevel"];
            $niveau = explode(" ", $clas);
            if (count($this->model->getIdByname($niveau[0])) === 0) {
                //Ajout d'un nouveau niveau si celui entrer n'existe pas;
                $this->model->addNewLevel($niveau[0], $groupeNiveau);
            }
            $idNiveau = $this->model->getIdByname($niveau[0])[0]["id_niveau"];
            // var_dump($idNiveau);
            $this->model->addclasse($clas, $idNiveau, $groupeNiveau);
            header("Location: http://localhost:8000/niveau/classe/".$groupeNiveau);
            // $this->classe($groupeNiveau);
        }
    }
}
