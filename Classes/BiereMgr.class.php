<?php
    
    class BiereMgr {
        
    public static function getListBiereTirageSix() {
        $db = DBTest_check :: getConnexion();
        $sql = "select * from biere where tirage = 6.40 ";
        $reponse = $db ->query($sql);
        $res = $reponse-> fetchAll(PDO::FETCH_ASSOC);
        $reponse->closeCursor();
        return $res;
    }

    




    



    }
?>