<?php 
    namespace Model;

    class ClasseModel extends MotherModel
    {
        public function addclasse($libelle, $niveau, $groupeNiveau)
    {
        $requete = "INSERT INTO classe(libelle_classe, id_niveau_classe, id_classe_GN) values(:libelle, :niveau, :groupeNiveau)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":libelle", $libelle);
        $requete->bindParam(":niveau", $niveau);
        $requete->bindParam(":groupeNiveau", $groupeNiveau);
        $requete->execute();
    }
    public function getIdByname($name)
    {
        $requete = "SELECT id_niveau from niveau where libelleNiveau = :name";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":name", $name);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function addNewLevel($name, $id)
    {
        $requete = "INSERT INTO niveau(id_niveau_GN, libelleNiveau) values(:id, :name)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":name", $name);
        $requete->bindParam(":id", $id);
        $requete->execute();
    }
   /*  public function CountClasse($idClasse)
    {
        $requete = "SELECT COUNT(*) AS total FROM  inscription where id_classe_inscription = :idClasse";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":idClasse", $idClasse);
        $requete->execute();
        return $requete->fetchAll();
    } */
    public function getLibelleById($id)
    {
        $requete = "SELECT libelle_classe from classe where id_classe = :id";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id", $id);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function getLibelleNiveauByID($id)
    {
        $requete = "SELECT  libelleGN from GroupeNiveau where id_GNiveau = :id";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id", $id);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function selectAlldiscipline($id_classe)
    {
        $requete = "SELECT * FROM discipline AS d INNER JOIN discipline_groupeDiscipline AS dg ON d.id_discipline = dg.id_discipline_association INNER JOIN classe AS c ON dg.id_classe_association = c.id_classe WHERE c.id_classe = :id_classe and dg.archive = 0";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function allStudent($id_classe)
    {
        $requete = "SELECT * FROM inscription, eleve WHERE id_classe_inscription = :id_classe and id_eleve_inscription = id_eleve";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->execute();
        return $requete->fetchAll();
    }
   
    }