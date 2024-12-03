<?php
    class FabricantMgr {

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









    }
?>