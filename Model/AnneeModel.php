<?php 
    namespace Model;

    use Model\MotherModel;
    
    class AnneeModel extends MotherModel
    {
        public function Allyear()
        {
            $requete = "SELECT * from annee where archive = 0";
            $requete = $this->bd->prepare($requete);
            $requete->execute();
            return $requete->fetchAll();
        }
    
        public function addYear($libelle)
        {
            $requete = "INSERT INTO annee(libelle,statut , archive) values(:libelle, 0, 0)";
            $requete = $this->bd->prepare($requete);
            $requete->bindParam(":libelle", $libelle);
            $requete->execute();
        }
        public function searchYear($libelle)
        {
            $requete = "SELECT * FROM annee where libelle =  :libelle";
            $requete = $this->bd->prepare($requete);
            $requete->bindParam(":libelle", $libelle);
            $requete->execute();
            return $requete->fetchAll();
        }
    }