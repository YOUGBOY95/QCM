<?php
session_start();
include "connect.php";
$idu = $_SESSION["idu"];
$niveau = $_SESSION["niveau"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Affichage des résultats</h1><hr>
    <table>
        <tr><th>Pseudo</th><th>Note / 20</th><th>Niveau (0 ou 1)</th><th>Date</th></tr>
        <?php
            if($niveau == 1){
                $req = "select u.pseudo, r.note, r.niveau, r.date 
                        from resultats r, users u 
                        where r.idu = u.idu
                        and u.idu = $idu";
                
            }else if($niveau == 2){
                $req = "select * from resultats r, users u 
                        where r.idu = u.idu";
                if(isset($_POST["bout"])){
                    $pseudo = $_POST["pseudo"];
                    if(!empty($_POST["dates"]) && isset($_POST["dates"])){
                        $dates = $_POST["dates"];
                        $req = "select * from resultats r, users u 
                        where r.idu = u.idu
                        and u.pseudo like '%$pseudo%'
                        and r.date>='$dates'";
                    }else{
                    $req = "select * from resultats r, users u 
                        where r.idu = u.idu
                        and u.pseudo like '%$pseudo%'";
                    }
                        
                }
            }
            $res = mysqli_query($id, $req);
            while($ligne = mysqli_fetch_assoc($res)){
                echo "<tr><td>".$ligne["pseudo"]."</td>
                          <td>".$ligne["note"]."</td>
                          <td>".$ligne["niveau"]."</td>
                          <td>".$ligne["date"]."</td>
                    </tr>";

            }
        ?>
    </table><hr>
    <h3>Recherche :</h3>
    <form action="" method="post">
        <input type="text" name="pseudo" placeholder="Pseudo"><br><br>
        Depuis le :  <input type="date" name="dates">
        <input type="submit" value="Rechercher" name="bout">
    </form>



</body>
</html>