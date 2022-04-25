<?php 
session_start();
if(!isset($_SESSION["pseudo"])){
    header("location:connexion.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Bonjour <?=$_SESSION["pseudo"]?>, choisissez d'abord le niveau des questions :</h3>
<form action="" method="post">
    <input type="radio" name="niveau" value="0" checked> Débutant
    <input type="radio" name="niveau" value="1"> Confirmé <br><br>
    <input type="submit" value="OK" name="bout">
    </form>
    <?php
    if(isset($_POST["bout"])){
        ?>
    <form action="reponse.php" method="post">
    <?php
    include "connect.php";
    $niveau = $_POST["niveau"];
    $_SESSION["niveauQCM"] = $niveau;
    $req = "select * from questions where niveau=$niveau order by rand() limit 10";
    $res = mysqli_query($id, $req);
    echo "<ol>";
    while($ligne = mysqli_fetch_assoc($res)){
        $idq = $ligne["idq"];
        echo "<h3><li>".$ligne["libelleQ"]."</li></h3>";
        $req2 = "select * from reponses where idq = ". $ligne["idq"];
        $res2 = mysqli_query($id, $req2);
        while($ligne2 = mysqli_fetch_assoc($res2)){
            $idr = $ligne2["idr"];
            echo "<input type='radio' name='$idq' value='$idr' checked> ".$ligne2["libeller"]."<br>";
        }
    }
    ?>
    <input type="submit" value="Envoyer">
</form>
<?php }
?>
</body>
</html>