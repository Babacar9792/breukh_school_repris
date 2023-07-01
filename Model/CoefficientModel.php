<?php

namespace Model;

class CoefficientModel extends MotherModel
{
    public function selectAlldiscipline($idClasse)
    {

        $requete = "SELECT  * FROM discipline AS d INNER JOIN discipline_groupeDiscipline AS dg ON d.id_discipline = dg.id_discipline_association INNER JOIN classe AS c ON dg.id_classe_association = c.id_classe WHERE c.id_classe = :id_classe and dg.archive = 0";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $idClasse);
        $requete->execute();
        return $requete->fetchAll();
    }
}
