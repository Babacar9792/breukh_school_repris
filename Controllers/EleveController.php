<?php
    namespace Controllers;

    use Model\EleveModel;

    class EleveController 
    {
        protected $model;

        public function __construct()
        {
            $this->model = new EleveModel();
        }
        public function note()
        {
            $data = json_decode(file_get_contents("php://input"), true);
            // $discipline = $this->model->getinfoDiscipline("id_dis", $data["idDiscipline"]);
            echo json_encode( $this->model->getinfoDiscipline("id_dis", $data["idDiscipline"]));
        }

    }