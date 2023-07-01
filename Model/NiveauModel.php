<?php

    namespace Model;

class  NiveauModel extends MotherModel
{
    
   
    public function searchLevel($id_annee, $name)
    {
        $requete = "SELECT * FROM GroupeNiveau where id_GNiveau_annee = :id_annee and libelleGN = :name";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_annee", $id_annee);
        $requete->bindParam(":name", $name);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function addLevel($nameGN, $id_annee)
    {
        $requete = "INSERT INTO GroupeNiveau(libelleGN, id_GNiveau_annee) values(:nameGN, :id_annee)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":nameGN", $nameGN);
        $requete->bindParam(":id_annee", $id_annee);
        $requete->execute();
    }
   
    public function getCurrentLevel($id_annee)
    {
        $requete = "SELECT libelleGN FROM GroupeNiveau WHERE id_GNiveau = :id_annee";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_annee", $id_annee);
        $requete->execute();
        $resultat = $requete->fetch();
    
        if ($resultat) {
            return $resultat['libelleGN'];
        } else {
            return null; // ou une valeur par défaut si aucun résultat n'est trouvé
        }
    }
    
}