<?php 
session_start();
include "connect.php";
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
    <h1>Résultat du QCM de <?=$_SESSION["pseudo"]?></h1>
    
       <h3> <a href="afficheResultats.php">Resultats</a></h3>
    
    <?php
    
    include "connect.php";
    //var_dump($_POST);
    $note = 0;
    foreach($_POST as $cle => $val){ //$cle c'est idq et $val c'est idr de sa reponse
       $req = "select * from reponses where idr=$val and verite=1";
       $res = mysqli_query($id, $req);
       if(mysqli_num_rows($res)>0){
            $note += 2; //$note = $note + 2
       }else{
           echo "Tu t'es planté à la question $cle : ";
           $req2 = "select * from questions where idq=$cle";
           $res2 = mysqli_query($id, $req2);
           $ligne = mysqli_fetch_assoc($res2);
            echo $ligne["libelleQ"]."<br>Il fallait répondre : ";
            $req3 = "select * from reponses where idq=$cle and verite=1";
           $res3 = mysqli_query($id, $req3);
           $ligne2 = mysqli_fetch_assoc($res3);
           echo "<b>".$ligne2["libeller"]."</b><br>";
       }
        // echo "A la question $cle tu as répondu $val<br>";
    }
    echo "<h2>tu as eu $note / 20</h2>";
    $idu = $_SESSION["idu"];
    $niveau = $_SESSION["niveauQCM"];
    $req = "insert into resultats values (null, $idu, $note, now(), $niveau)";
    
    mysqli_query($id, $req);

    ?>
<h3><a href="deconnexion.php">Deconnexion</a></h3>
</body>
</html>