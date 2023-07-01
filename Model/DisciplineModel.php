<?php

namespace Model;

class DisciplineModel extends MotherModel
{
        public function AllGroupeDiscipline()
        {
                $requete = "SELECT * FROM GroupeDiscipline";
                $requete = $this->bd->prepare($requete);
                $requete->execute();
                return $requete->fetchAll();
        }
        public function addGroupeDiscipline($donnee)
        {
                $requete = "INSERT INTO GroupeDiscipline(libelle_GroupeDiscipline) values(:donnee)";
                $requete = $this->bd->prepare($requete);
                $requete->bindParam(":donnee", $donnee);
                return $requete->execute();
        }
        public function isGroupeDisciplineExists($donnee)
        {
                $requete = "SELECT * from GroupeDiscipline where libelle_GroupeDiscipline = :donnee";
                $requete = $this->bd->prepare($requete);
                $requete->bindParam(":donnee", $donnee);
                $requete->execute();
                return $requete->fetchAll();
        }
        public function allDisciplineByClasse($id_classe)
        {
                $requete = "SELECT * FROM discipline JOIN discipline_groupeDiscipline on id_discipline = id_discipline_association where id_classe_association = :id_classe and discipline_groupeDiscipline.archive = 0 ";
                $requete = $this->bd->prepare($requete);
                $requete->bindParam(":id_classe", $id_classe);
                $requete->execute();
                return $requete->fetchAll();
        }

        public function deleteDiscipline($id_dis)
        {
                $requete = "DELETE FROM discipline_groupeDiscipline where id_dis = :id_dis";
                $requete = $this->bd->prepare($requete);
                $requete->bindParam(":id_dis", $id_dis);
                $requete->execute();
        }
       
        public function getDiscipline($colonne, $valeur)
        {
                $requete = "SELECT * FROM discipline where $colonne = :valeur";
                $requete = $this->bd->prepare($requete);
                $requete->bindParam(":valeur", $valeur);
                $requete->execute();
                return $requete->fetchAll();
        }

        /** 
         * Fonction verifier si une discipline à déjà été ajoutée à une classe ou pas .Elle prend en paramètre l'id de la discipline et l'id de la classe. Elle cherche dans la table d'association la ligne qui contiient en meme temps ces deux informations 
         */
        public function disciplineInClasse($id_classe, $id_discipline)
        {
                $requete = "SELECT * FROM discipline_groupeDiscipline where id_discipline_association = :id_discipline and id_classe_association = :id_classe";
                $requete = $this->bd->prepare($requete);
                $requete->bindParam(":id_discipline", $id_discipline);
                $requete->bindParam(":id_classe", $id_classe);
                $requete->execute();
                return $requete->fetchAll();
        }
        public function disciplineExiste($discipline)
        {
                $requete = "SELECT * FROM discipline WHERE libelle_discipline = :discipline";
                $requete = $this->bd->prepare($requete);
                $requete->bindParam(":discipline", $discipline);
                $requete->execute();
                return $requete->fetchAll();
        }
        /**
         * fonction pour ajouter une nouvelle discipline dans la table des disciplines;
         */
        public function insertDiscipline($discipline, $idGD, $code_dis)
        {
                $requete = "INSERT INTO discipline(libelle_discipline, id_discipline_groupe, code_discipline) values(:discipline, :idGD, :code_dis)";
                $requete = $this->bd->prepare($requete);
                $requete->bindParam(":discipline", $discipline);
                $requete->bindParam(":idGD", $idGD);
                $requete->bindParam(":code_dis", $code_dis);
                $requete->execute();
        }
        /**
         *  Fonction pour inserer dans la table d'association discipline_groupeDiscipline
         */

        public function addDisciplineClasse($id_classe, $id_discipline)
        {
                $requete = "INSERT INTO discipline_groupeDiscipline(id_discipline_association, id_classe_association) values(:id_discipline, :id_classe)";
                $requete = $this->bd->prepare($requete);
                $requete->bindParam(":id_classe", $id_classe);
                $requete->bindParam(":id_discipline", $id_discipline);
                $requete->execute();
        }
        public function insertAssociationDiscipline($discipline, $idGD, $code_dis, $id_classe)
        {
                $this->insertDiscipline($discipline, $idGD, $code_dis);
                $id_newdis = $this->getLastInsert("discipline", "id_discipline")[0]["id_discipline"];
                $this->addDisciplineClasse($id_classe, $id_newdis);
        }
}
