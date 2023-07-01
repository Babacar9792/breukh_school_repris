<?php

namespace Controllers;

use Model\DisciplineModel;
session_start();

class DisciplineController
{
    protected $model;

    public function __construct()
    {
        $this->model = new DisciplineModel();
    }
    public function gestion()
    {
        $currentYear = $this->model->getYear(1);
        // $years = $this->model->getYear(0);
        $level = $this->model->AllNiveau($currentYear[0]["id_annee"]);
        $Gdiscilpline = $this->model->AllGroupeDiscipline();
        require "../Views/Discipline.php";
    }

    public function classe($id)
    {
        $classes = $this->model->allClasse($id);
        header('Content-Type: application/json');
        echo json_encode($classes);
    }

    /* *
            *Fonction pour ajouter un nouveau groupe de discipline. 
            elle vérifie d'abord si le groupe de existe ou pas. Si elle existe ile renvoie un message pour notifier que le groupe de discipline existe déjà 
            Sinon, il l'ajout à la base de donnée et envoi un message de confirmation.          
        */
    public function addGroupeDiscipline()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $groupeDiscipline = $data["groupeDiscipline"];

        // Vérifier si la valeur existe déjà
        if (count($this->model->isGroupeDisciplineExists($groupeDiscipline)) != 0) {
            echo json_encode(["message" => "Ce groupe de discipline existe déjà"]);
            return;
        }

        // Ajouter le groupe de discipline
        $requete = $this->model->addGroupeDiscipline(strtoupper($groupeDiscipline));
        header('Content-Type: application/json');

        if ($requete) {
            $Gdiscipline = $this->model->getLastInsert("GroupeDiscipline", "id_GroupeDiscipline")[0]; // Récupérer les données du groupe de discipline ajouté
            $Gdiscipline["message"] = "Ajout effectué avec succès"; // Ajouter un message de succès
            echo json_encode($Gdiscipline);
        } else {
            echo json_encode(["message" => "Une erreur s'est produite lors de l'ajout du groupe de discipline"]);
        }
    }
    public function alldisciplineByClasse($id)
    {
        header('Content-Type: application/json');
        echo json_encode($this->model->allDisciplineByClasse($id));
    }
    public function delete()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        header('Content-Type: application/json');
        for ($i = 0; $i < count($data); $i++) {
            $this->model->delete("discipline_groupeDiscipline", $data[$i], "id_dis");
        }
        echo json_encode(["message" => "Suppression réussie"]);
    }

    //fonction pour ajouter un nouveau groupe de discipline
    /**
     *fonction pour ajouter une nouvelle discipline . Celle ci vérifie d'abord si la discipline saisie existe , 
     *Si elle existe , alors on récupere son id et son code  puis on vérifie si la classe choisie ne contient pas cette discipline
     *Si la classe contient cette discipline, on ne l'ajoute pas dans la classe d'association,
     *Si elle ne contient pas cette discipline, alors on l'ajoute dans la classe d'assocition,
     *Si la discipline n'existe pas, alors on l'ajoute d'abord dans la table discipline, puis on insert dans la table d'association

     */
    public function addDiscipline()
    {

        $data = json_decode(file_get_contents("php://input"), true);
        $disciplineExiste = $this->model->disciplineExiste($data["discipline"]);
        //Je vérifie d'abord si la discipline existe ou pas dans la table des disciplines
        if (count($disciplineExiste) === 0) {

            $code = $this->genereCode($data["discipline"]);
            $this->model->insertAssociationDiscipline(strtoupper($data["discipline"]), $data["groupeDiscipline"], $code, intval($data["classe"]));
            $disciplines = $this->model->allDisciplineByClasse(intval($data["classe"]));
            echo json_encode(["data" => ["message" => "Discipline ajouter avec succes", "disciplines" => $disciplines]]);
        } else {
            // $code = $disciplineExiste[0]["code_discipline"];
            $id_discipline = $disciplineExiste[0]["id_discipline"];
            if (count($this->model->disciplineInClasse($data["classe"], $id_discipline)) === 0) {
                $this->model->addDisciplineClasse($data["classe"], $id_discipline);
                $disciplines = $this->model->allDisciplineByClasse(intval($data["classe"]));
                echo json_encode(["data" => ["message" => "la discipline a été ajoutée à la classe", "disciplines" => $disciplines]]);
            } else {
                $this->model->updateStatutYear("discipline_groupeDiscipline", "archive", $this->model->disciplineInClasse($data["classe"], $id_discipline)[0]["id_dis"], 0, "id_dis");
                $disciplines = $this->model->allDisciplineByClasse(intval($data["classe"]));
                echo json_encode(["data" => ["message" => "discipline ajouté ou mise à jour", "disciplines" => $disciplines]]);
            }
        }
    }



    /**
     * Fonction pour générer un code selon la discipline qui lui est placé en paramètre.
     */
    public function genereCode($discipline)
    {
        $tabCode = explode(" ", $discipline);
        $code = "";
        if (count($tabCode) === 1) {
            // echo json_encode(["long"=>count($tabCode)]);
            // var_dump(count($tabCode));
            // die();
            $code = $code . substr($discipline, 0, 3);
            $nombre = count($this->model->getDiscipline("code_discipline", strtoupper($code)));
            $longueurCode = strlen($code);
            while ($nombre != 0) {
                $longueurCode = $longueurCode + 1;
                $code = "" . substr($discipline, 0, $longueurCode);
                $nombre = count($this->model->getDiscipline("code_discipline", strtoupper($code)));
            }
        } else {
            for ($i = 0; $i < count($tabCode); $i++) {
                $code = $code . $tabCode[$i][0];
            }
        }
        // return count($tabCode);
        return strtoupper($code);
    }
}
