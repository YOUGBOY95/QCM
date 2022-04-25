<?php
session_start();
require "connect.php";
if(isset($_POST["bout"])){
    $pseudo = $_POST["pseudo"];
    $mdp = $_POST["mdp"];
    $req = "select * from users where pseudo='$pseudo' and mdp='$mdp'";
    $res = mysqli_query($id, $req);
    if(mysqli_num_rows($res) > 0){
       $ligne = mysqli_fetch_assoc($res);
       $_SESSION["idu"] = $ligne["idu"];
       $_SESSION["niveau"] = $ligne["niveau"];
        $_SESSION["pseudo"] = $pseudo;
        header("location:qcmv2.php"); 
    }else{
        $erreur = "Erreur de pseudo ou de mot de passe...";
    }
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
    <h1>Connexion au QCM</h1><hr>
    <form action="" method="post">
        <input type="text" name="pseudo" placeholder="Pseudo :" required><br><br>
        <input type="password" name="mdp" placeholder="Mot de passe :" required><br><br>
        <?php if(isset($erreur)) echo "<h3>$erreur</h3>";?>
        <input type="submit" value="Connexion" name="bout">
    </form><hr>
</body>
</html>