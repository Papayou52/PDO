<?php
 $dsn = 'mysql:dbname=test_check;host=localhost:3306';
 try {
 $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8');
 $connexion = new PDO($dsn, "root","",$option);
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
   
    $reponse = $connexion ->query("select * from biere where tirage = 6.40 ");
    while($donnees = $reponse->fetch(PDO::FETCH_OBJ) ){
        echo $donnees->nomBiere."<br>";
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

</body>
</html>
