<?php 

namespace Model;

use Model\ConnexionBd;

use PDO;

class MotherModel
{
    private $pdo;


    protected   PDO $bd;

    public function __construct()
    {
        $this->pdo = new ConnexionDb();
        $this->bd = $this->pdo->connexion();
    }
    public function getYear($data)
    {
        $requete = "SELECT * from annee where statut = :statut and archive = 0";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(':statut', $data);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function updateStatutYear($table, $colonne, $id, $donnee,$idRef)
    {
        $requete = "UPDATE $table SET $colonne = :donnee where $idRef = :id";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":donnee", $donnee);
        $requete->bindParam(":id", $id);
        $requete->execute();
    }
    public function delete($table, $id, $colonne)
    {
        $requete = "UPDATE $table SET archive = 1 where $colonne = :id";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id", $id);
        $requete->execute();
    }
    public function allNiveau($idAnnee)
    {
        $requete = "SELECT * FROM GroupeNiveau where id_GNiveau_annee = :id_annee and archive = 0";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_annee", $idAnnee);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function allClasse($idGNiveau)
    {
        $requete = "SELECT * FROM classe where id_classe_GN = :idGNiveau and archive = 0";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":idGNiveau", $idGNiveau);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function getLastInsert($table, $primaryKey)
    {
        $requete = "SELECT * FROM $table ORDER BY $primaryKey DESC LIMIT 1";
        $requete = $this->bd->prepare($requete);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function getLibelleByName($table, $coloneReference, $valeur)
    {
        $requete = "SELECT * FROM $table where $coloneReference = :valeur";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":valeur", $valeur);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function selectAlldiscipline($id_classe)
    {

        $requete = "SELECT  * FROM discipline AS d INNER JOIN discipline_groupeDiscipline AS dg ON d.id_discipline = dg.id_discipline_association INNER JOIN classe AS c ON dg.id_classe_association = c.id_classe WHERE c.id_classe = :id_classe and dg.archive = 0";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->execute();
        return $requete->fetchAll();
    }
    /** 
     * Fonction pour calculer le nombre d'éléments
    */
    public function CountClasse($table, $idReference, $valeurId)
    {
        $requete = "SELECT COUNT(*) AS total FROM  $table where $idReference = :valeurId";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":valeurId", $valeurId);
        $requete->execute();
        return $requete->fetchAll();
    }

    public function getinfoDiscipline($colonne, $valeur)
    {
            $requete = "SELECT * FROM discipline_groupeDiscipline where $colonne = :valeur";
            $requete = $this->bd->prepare($requete);
            $requete->bindParam(":valeur", $valeur);
            $requete->execute();
            return $requete->fetchAll();
    }
   
}