<?php 

// require __DIR__."/session.php";

    if(!isset($_SESSION["id"])){
        $menu = [
    
            "index.php" => "Acceuil",
            "connexion.php" => "Se connecter",
            "inscription.php" => "S'inscrire"
        
        ];
        
    }else{
        $menu = [
            "index.php" => "Acceuil",
            "formulaireVoiture.php" => "Enregistrer ma voiture",
            "formulaireAnnonce.php" => "Créer une annonce",
            "deconnexion.php" => "Se déconnecter",
            "profil.php" => "Profil"
        ];
        
    }



function afficherMenu($menu)
{
    echo "<nav>
    <img src='img/Ventacarrogne.png'   alt=''>
    <ul>";
    foreach ($menu as $key => $value) {
        echo '<li><a href="'.$key.'">'.$value.'</a> </li>';
    }
    '</ul>
    </nav>';
}
?>

