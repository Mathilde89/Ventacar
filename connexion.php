<?php


require __DIR__ . "/pdo.php";
require __DIR__."/session.php";

function verifconnexion($pdo)
{
    // Reccupère tous les users
    $query2 = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
    $query2->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
    $query2->execute();
    $user = $query2->fetch(PDO::FETCH_ASSOC);
    //Permet de tester si le mail est dans la base
    if ($user) {



        // Pour tester si bon mot de passe 

        //Permet de decrypter le mot de passe
        $hash = $user["password"];

        if (password_verify($_POST["password"], $hash)) {

            //Mets à dispo les informations de connexion pour toutes les autres pages
            $_SESSION['id'] = $user["id"];
            $_SESSION['nom'] = $user["name"];
            $_SESSION['prenom'] = $user["firstname"];
            $_SESSION['email'] = $user["email"];

            $id_session = session_id();
            // var_dump($_COOKIE['PHPSESSID']);
            // var_dump($id_session);
            // var_dump($_SESSION);

            header("Location: index.php");
       
            // echo "Le mot de passe est valide";
        } else {

            echo "Email ou mot de passe invalide";
        }
    } else {
        echo "Email ou mot de passe invalide";
    }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tenor+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.scss">
    <title>Document</title>
</head>

<body>
    <header>

        <?php
        include __DIR__ . "/menu.php";
        afficherMenu($menu);
        ?>

    </header>

    <h2>Connexion au site VentaCar</h2>
    <?php if (isset($_POST["submitConnexion"])) {
        verifconnexion($pdo) ?>

    <?php }; ?>


    <form class="inscon" action="connexion.php" method="post">

        <label for="email">Email</label>
        <input type="email" id="email" name="email">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">


        <input type="submit" value="Connexion" name="submitConnexion">
    </form>
</body>

</html>