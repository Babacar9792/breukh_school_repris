<?php 
    namespace Model;
    class UserModel extends MotherModel
    {
        public function tryConnexion($loginUser, $passWordUser)
        {
            $requete = "SELECT * FROM Users WHERE loginUser = :loginUser and passWordUser = :passWordUser";
            $requete = $this->bd->prepare($requete);
            $requete->bindParam(":loginUser", $loginUser);
            $requete->bindParam(":passWordUser", $passWordUser);
            $requete->execute();
            return $requete->fetchAll();

        }
    }