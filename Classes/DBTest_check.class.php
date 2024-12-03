<?php
    
    class DBTest_check{
        private static $connexion;

        private static function connect(){
            $tparam = parse_ini_file("param.ini",true);
            extract($tparam['BDD']);
            
                $dsn = 'mysql:dbname='.$DBNAME.';
                        host='.$DBHOST.';
                        port='.$DBPORT;
                try {
                $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8');
                self :: $connexion = new PDO($dsn, $DBSER,$DBPASS,$option);
                echo "Connexion à la DB ".$DBNAME." réussie <br>";
                return self :: $connexion ;
                } catch (PDOException $e){
                    printf("Echec de connexion : %s\n",$e->getMessage());
                }
        }

        // Singloton
        public static function getConnexion(){
            if (self :: $connexion != null )
                return self :: $connexion;
            else
            return self :: connect();
        }










    }
?>