<?php
    require_once("Classes/DBTest_check.class.php");
    require_once("Classes/BiereMgr.class.php");
    require_once("Classes/FabricantMgr.class.php");
    require_once("Classes/Fabricant.class.php");
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
    <!-- <h1>Requêtes INSERT</h1>
    <p>TO FIXE</p>
    <form action="" method="post">
    Nom du fabricant <input type="text" name="nom"> 
    <input type="submit">
    </form> -->


     <?php
    // $sql = "INSERT INTO `fabricant`(`nomFabricant`) VALUES (:nom)";
    // $reponse = $db->prepare($sql);
    // $nom = $_POST["nom"];

    // $reponse->execute(array(":nom"=>$nom));
    // $reponse->closeCursor();
    // $nom = null;
    // $_POST = null;
?> 
    <!-- <h1>Liste des fabricant pour test l'ajout</h1> -->
<?php
    // $reponse = $db ->query("select * from Fabricant ");
    // while($donnees = $reponse->fetch(PDO::FETCH_OBJ) ){
    //     echo $donnees->nomFabricant."<br>";
    // }
    // $reponse->closeCursor();
?>
    <h1>Ajout Fabricant</h1>
<?php
    $f1 = new Fabricant('Charles',11);

    $rep = FabricantMgr :: addFabricant($f1);
    
    echo "New ID : ".$rep."<br>";
    
?>
    <h1>Delete Fabricant</h1>
<?php
    // Fonctionne mais doit pouvoir retrouver le bonne id en regardant dans la DB
    //Delete by ID
    $id = FabricantMgr :: addFabricant($f1);
    $rep = FabricantMgr :: delFabricantById($id);
    
    echo "Fab delete (by ID) : ".$rep."<br>";
    // DeleteFab
    $f2 = new Fabricant('adelete',11);

    $rep = FabricantMgr :: addFabricant($f2);
    $id = FabricantMgr :: addFabricant($f2);
    $rep = FabricantMgr :: delFabricant($f2);
    echo "Fab delete : ".$rep."<br>";
?>

    <h1>Update Fabricant</h1>

<?php
$f10 = new Fabricant('aDelete',-1);

$rep = FabricantMgr :: addFabricant($f10);

$aDelete = FabricantMgr :: getFabricantByName('ADelete')[0];
echo "test";
$aDelete->setNom("A_pas_delete");
$update = FabricantMgr :: updateFabricant($aDelete);
$aDelete  = FabricantMgr :: getFabricantByName('A_pas_delete')[0];
echo $aDelete;
?>


</body>
</html>
