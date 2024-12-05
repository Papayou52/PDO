<?php
    class FabricantMgr {


        public static function addFabricant(Fabricant $fabricant){
            $db = DBTest_check :: getConnexion();
            $sql = "INSERT INTO `fabricant`(`nomFabricant`) VALUES (:nom)";
            $requete = $db->prepare($sql);
            $requete->execute(array(':nom'=>$fabricant->getNom_Fabricant()));
            $requete->closeCursor();

            $retour = $db->lastInsertId();
            return $retour;
        }

        public static function delFabricantById(int $id){
            $db = DBTest_check :: getConnexion();
            $sql = "DELETE FROM `fabricant` WHERE idFabricant = ?";
            $requete = $db->prepare($sql);
            $requete->execute(array($id));

            $nrdelete = $requete->rowCount();

            $requete->closeCursor();

            
            return $nrdelete;
        }

        public static function delFabricant(Fabricant $fabricant) : int {
            return self :: delFabricantById($fabricant->getId_Fabricant());
        }


        public static function getFabricantById(int $idFabricant, int $choix = PDO::FETCH_ASSOC) {
            $db = DBTest_check :: getConnexion();
            $sql = "SELECT * FROM `fabricant` WHERE idFabricant = ?";
            $requete = $db->prepare($sql);
            $requete->execute(array($idFabricant));

            $record = $requete->fetch($choix);
            $requete->closeCursor();
            return $record;
        }

        public static function getFabricantByIdAndLettre (int $idFabricant, string $lettreFabricant,int $choix = PDO::FETCH_ASSOC){
            $db = DBTest_check :: getConnexion();
            $sql = "SELECT * FROM `fabricant` WHERE idFabricant = :ID and nomFabricant like :I";
            $requete = $db->prepare($sql);
            $requete->execute(array(":ID"=>"$idFabricant",":I"=>"%$lettreFabricant%"));

            $record = $requete->fetch($choix);
            $requete->closeCursor();
            return $record;

        }

        public static function getFabricantByName (string $name) :array{
            $db = DBTest_check :: getConnexion();
            $sql = "SELECT * FROM `fabricant` WHERE nomFabricant like (:nom)";
            $requete = $db->prepare($sql);
            $requete->execute(array(":nom"=> "%".$name."%"));
            $requete->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,
                                    "Fabricant",array("nomFabricant","idFabricant"));

            $record = $requete->fetchAll();
            $requete->closeCursor();

            if ($record==false) {
                throw new FabricantsMgrException("Erreur : Nom fabricant inconnu");
            }
            return $record;
        }

        public static function updateFabricant (Fabricant $fabricant) {
            $db = DBTest_check :: getConnexion();
            $sql = "UPDATE fabricant SET nomFabricant = :nom WHERE idFabricant = :id";
            $requete = $db->prepare($sql);

            $requete->execute(array(":nom"=>$fabricant->getNom_Fabricant(),":id"=>$fabricant->getId_Fabricant()));
            $nbE = $requete->rowCount();

            $requete->closeCursor();

            return $nbE;
        }







    }
?>