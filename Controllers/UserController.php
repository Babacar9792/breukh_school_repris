<?php 
    namespace Controllers;

    use Model\UserModel;
class UserController
{
    private $model;
    public function __construct()
    {
        $this->model = new UserModel();
    }
    public function tryConnexion()
    {
        // $data = json_decode(file_get_contents("php://input"), true);
        // $verification = $this->model->tryConnexion($data["login"], $data["passWord"]);
        // if(count($verification)=== 0){
        //     echo json_encode(["message" => "Login ou mot de passe incorrecte"]);
        // }
        // else 
        // {
        //     // echo json_encode(["message" => "connexion reussi"]);
        // }
        require "../Views/niveau.php";
    }
}