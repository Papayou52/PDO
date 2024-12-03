<?php
    require("Classes/DBTest_check.class.php");
    require("Classes/BiereMgr.class.php");
    require("Classes/FabricantMgr.class.php");
    // $tparam = parse_ini_file("param.ini",true);
    // extract($tparam['BDD']);

    // $dsn = 'mysql:dbname='.$DBNAME.';
    //         host='.$DBHOST.';
    //         port='.$DBPORT;
    try {
        $db = DBTest_check :: getConnexion();
    // $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //                 PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8');
    // $connexion = new PDO($dsn, $DBSER,$DBPASS,$option);
    } catch (PDOException $e){
        printf("Echec de connexion : %s\n",$e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste des bières</h1>
<?php
    $rep = BiereMgr :: getListBiereTirageSix();
    var_dump($rep);
?>

<?php
    // $sql = "SELECT * FROM `fabricant` WHERE idFabricant = ?";
    // $reponse = $db->prepare($sql);
    // $reponse->execute(array(1));
?>
    <h1>Requêtes préparées</h1>
<?php
    $rep = FabricantMgr :: getFabricantById(1,PDO :: FETCH_OBJ);
    var_dump($rep->nomFabricant);
    // while($data = $reponse->fetch(PDO::FETCH_BOTH)){
    //     echo $data['nomFabricant']."<br>";
    // }
    // $reponse->closeCursor();
?>

<?php
    // $sql = "SELECT * FROM `fabricant` WHERE idFabricant = :ID and nomFabricant like :I";
    // $reponse = $db->prepare($sql);
    // $reponse->execute(array(":ID"=>"1",":I"=>"%I%"));
?>
    <h1>Requêtes préparées (Paramètres nommés)</h1>
<?php
    $rep = FabricantMgr :: getFabricantByIdAndLettre(1,"i");
    var_dump($rep);
    // while($data = $reponse->fetch(PDO::FETCH_BOTH)){
    //     echo $data['nomFabricant']."<br>";
    // }
    // $reponse->closeCursor();
?>
    <h1>Requêtes INSERT</h1>
    <p>TO FIXE</p>
    <form action="" method="post">
    Nom du fabricant <input type="text" name="nom"> 
    <input type="submit">
    </form>


     <?php
    // $sql = "INSERT INTO `fabricant`(`nomFabricant`) VALUES (:nom)";
    // $reponse = $db->prepare($sql);
    // $nom = $_POST["nom"];

    // $reponse->execute(array(":nom"=>$nom));
    // $reponse->closeCursor();
    // $nom = null;
    // $_POST = null;
?> 
    <h1>Liste des fabricant pour test l'ajout</h1>
<?php
    $reponse = $db ->query("select * from Fabricant ");
    while($donnees = $reponse->fetch(PDO::FETCH_OBJ) ){
        echo $donnees->nomFabricant."<br>";
    }
    $reponse->closeCursor();
?>

</body>
</html>
