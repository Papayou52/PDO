<?php
    $tparam = parse_ini_file("param.ini",true);
//var_dump($tparam);
    extract($tparam['BDD']);

    $dsn = 'mysql:dbname='.$DBNAME.';
            host='.$DBHOST.';
            port='.$DBPORT;
    try {
    $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8');
    $connexion = new PDO($dsn, $DBSER,$DBPASS,$option);
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
    <h1>Liste des bières (OBJ)</h1>
<?php
   
    $reponse = $connexion ->query("select * from biere where tirage = 6.40 ");
    while($donnees = $reponse->fetch(PDO::FETCH_OBJ) ){
        echo $donnees->nomBiere."<br>";
    }
    $reponse->closeCursor();
?>
<h1>Liste des bières (ASSOC)</h1>
<?php
   
    $reponse = $connexion ->query("select * from biere where tirage = 5.70 ");
    while($donnees = $reponse->fetch(PDO::FETCH_ASSOC) ){
        echo $donnees["nomBiere"]."<br>";
    }
    $reponse->closeCursor();
?>
<h1>Liste des bières (NUM)</h1>
<?php
   
    $reponse = $connexion ->query("select * from biere where tirage = 5.10 ");
    while($donnees = $reponse->fetch(PDO::FETCH_NUM) ){
        echo $donnees[1]."<br>";
    }
    $reponse->closeCursor();
?>
<?php
    $sql = "SELECT * FROM `fabricant` WHERE idFabricant = ?";
    $reponse = $connexion->prepare($sql);
    $reponse->execute(array(1));
?>
    <h1>Requêtes préparées</h1>
<?php
    while($data = $reponse->fetch(PDO::FETCH_BOTH)){
        echo $data['nomFabricant']."<br>";
    }
    $reponse->closeCursor();
?>
<?php
    $sql = "SELECT * FROM `biere` WHERE idmarque = ?";
    $reponse = $connexion->prepare($sql);
    $reponse->execute(array(360));
?>
    <h1>Requêtes préparées</h1>
<?php
    while($data = $reponse->fetch(PDO::FETCH_BOTH)){
        echo $data['nomBiere']."<br>";
    }
    $reponse->closeCursor();
?>
</body>
</html>
