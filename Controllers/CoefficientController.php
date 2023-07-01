<?php 
     namespace Controllers;
     session_start();

     use Model\CoefficientModel;
     use Exception;

     class CoefficientController
     {
        protected $model;

        public function __construct()
        {
            $this->model = new CoefficientModel();
        }
        public function Coefficient($id)
        {
    
    
            try {
                $maClasse = $this->model->getLibelleByName("classe", "id_classe", $id);
                $years = $this->model->getYear(0);
                $currentYear = $this->model->getYear(1);
                $discipline = $this->model->selectAlldiscipline($id);
                $_SESSION["currentClasse"] = $id;
                // echo json_encode($discipline);
                require "../Views/Coefficient.php";
            } catch (Exception $th) {
                echo "error" . $th->getmessage();
            }
        }
        public function updateCoefficient()
        {
            $data = json_decode(file_get_contents('php://input'), true);
            foreach ($data as $value) {
                $this->model->updateStatutYear("discipline_groupeDiscipline", $value["typeNote"], $value["idNote"], $value["valeur"], "id_dis");
            }
            echo json_encode(["message" => "Données mise à jours avec succes"]);
        }
        public function deleteDiscipline($id)
        {
            $this->model->updateStatutYear("discipline_groupeDiscipline", "archive", $id, 1, "id_dis");
            echo json_encode(["message" => "La dsicipline a bien été supprimer de la classe"]);
        }
     }