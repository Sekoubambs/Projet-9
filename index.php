<?php

session_start()

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class=container>

<header class="header">

    <h1>Liste des films MARVEL</h1>

</header>



<section>


    <nav>

        <ul class=d-inline-block>

           <a href='index.php?page=accueil'>Accueil</a>
           <a href='index.php?page=user'>Films</a>
           <a href='index.php?page=settings'>Maj films</a>
           
           <?php 
                if (isset($_SESSION) and !empty($_SESSION)){ ?>
                     <a href="?page=connexion">Déconnexion</a>
                <?php } else { ?>
                    <a href="?page=connexion">Connexion</a>
                <?php }
                ?>


        </ul>

    </nav>

    <?php




// Configuration de la base de données
        $host = "localhost";
        $dbname = "marvel";
        $username = "root";
        $password = "";

// Connexion à la base de données
        $dbconnect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// CREATE


    if (isset($_POST["submitCreate"])) {
        $nomFilm = $_POST['Nom_du_film'];
        $dateDeSortie = $_POST['dateDeSortie'];
        $duree = $_POST['Durée'];
        $affiche = $_POST['affiche'];
        $nomRealisateur = $_POST['Nom_réalisateur'];
        $prenomRealisateur = $_POST['Prenom_réalisateur'];
        $nomActeur = $_POST['Nom_acteur'];
        $prenomActeur = $_POST['Prenom_acteur'];
        $genre = $_POST['genre'];

        $sql = "INSERT INTO `film`(`Nom_du_film`, `dateDeSortie`, `Durée`, `affiche`) VALUES ('$nomFilm','$dateDeSortie','$duree','$affiche')";
        $stmt = $dbconnect->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `réalisateur`(`Nom_réalisateur`, `Prenom_réalisateur`) VALUES ('$nomRealisateur','$prenomRealisateur')";
        $stmt = $dbconnect->prepare($sql);
        $stmt->execute();

        $sql = "INSERT INTO `acteur`(`Nom_acteur`, `Prenom_acteur`) VALUES ('$nomActeur','$prenomActeur')";
        $stmt = $dbconnect->prepare($sql);
        $stmt->execute();

        header("refresh:1;http://localhost/projet%209/index.php?page=settings");
    }


// Read

        $sql = "SELECT * FROM `film`";
        $stmt = $dbconnect->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
        foreach ($result as $value) {
            echo '<div class="card">';
            echo '<h3>' . $nomFilm . '</h3>';
            echo '<p><strong>Date:</strong> ' . $dateDeSortie . '</p>;
            echo '<p><strong>Durée:</strong> ' . $duree .  minutes '</p>;
            <img src="' . $affiche . '" alt="Affiche du film">;
            </div>';
              }
      

?>

    <?php

        if (isset($_GET['page']) && $_GET['page'] == "accueil" && empty($_SESSION)) {

            echo '<form class="form" method="POST">';
            echo '<p>Identifiant</p><input type="text" name="identifiant">';
            echo '<p>Mot de passe</p><input type="password" name="password">';
            echo '<p>Email</p><input type="email" name="email">';
            echo '<br>';
            echo '<br>';
            echo '<input type="submit" name="submit" value="connexion">';
            echo '</form>';
    
        }
    ?>


    <?php
 


// *********************************************** Accueil ********************************************************************************************
 
if (isset($_POST['submit']) && ($_POST['identifiant'] == 'sekoubambs' && $_POST['password'] === '100385')) {



    $_SESSION = [
        'identifiant' => 'sekoubambs',
        'password' => '100385',
        'age' => 38 , 
        'nom' => 'haidara',
        'prenom' => 'amadou',
        'role' => 'stagiaire',
    ] ;
    
          echo 'Bienvenue ' . $_SESSION['prenom'] . '!!!';

        
      }

  if (isset($_POST['submit']) && ($_POST['identifiant'] != 'sekoubambs' || $_POST['password'] != '100385')) {
      
      echo 'Votre identifiant ou votre mot de passe est incorrect' ;
  }

  if (isset($_GET['page']) && $_GET['page'] == "accueil" && !empty($_SESSION)) {
      ?>
      <h1>Bonjour et bienvenue sur votre page d'accueil !!!</h1>
      <p class="alert-success">Vous êtes maintenant Connecté</p>
      <?php
      }


// *********************************************** User ********************************************************************************************


        if (isset($_GET['page']) && $_GET['page'] == 'user' && empty($_SESSION)){ ?>
                <p class="alert warning">Vous devez être connecté pour pouvoir avoir accès à cette partie du site</p>
            <?php }
        
        if (isset($_GET['page']) && $_GET['page'] == "user" && !empty($_SESSION) ) {


    }  
        ?>
         
        
      

<?php  
        if (isset($_GET['page']) && $_GET['page'] == "settings" && empty($_SESSION)) { ?>
        <p class="alert warning">Vous devez être connecté pour pouvoir avoir accès à cette partie du site</p>
        <?php }
        
        if (isset($_GET['page']) && $_GET['page'] == 'settings' && !empty($_SESSION)){ 

             echo   '<form method="post">';
             echo   '<input type="text" name="Nom_du_film" placeholder="Nom du film">';
             echo   '<br>';
             echo   '<br>';
             echo   '<input type="text" name="Nom_réalisateur" placeholder="Nom du réalisateur">';
             echo   '<br>';
             echo   '<input type="text" name="Prenom_réalisateur" placeholder="Prénom du réalisateur">';
             echo   '<br>';
             echo   '<input type="text" name="Nom_acteur" placeholder="Nom Acteur">';
             echo   '<br>';
             echo   '<input type="text" name="Prenom_acteur" placeholder="Prénom Acteur">';
             echo   '<br>';
             echo   '<input type="date" name="dateDeSortie">';
             echo   '<br>';
             echo   '<input type="number" name="Durée" placeholder="Durée">';
             echo   '<br>';
             echo   '<input type="text" name="genre" placeholder="Genre">';
             echo   '<br>';
             echo   '<input type="url" name="affiche" placeholder="Affiche">';
             echo   '<br>';
             echo   '<input type="submit" name="submitCreate" value="Ajouter film">';
             echo   '<br>';
             echo   '<br>';
             echo   '<br>';
             echo   '<input type="submit" name="submitDelete" value="Supprimer film">';

                    '</form>';

        }

        ?>




            <!-- <form action="index.php"  method="POST" class="formConnexion" >
                <h1>Mise à jour des films</h1>
                <label for="nom">Nom</label>
                <input type="text" name="nom" value="<?php echo $_SESSION['nom']; ?>">
                <br>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">
                <br>
                <label for="age">Age</label>
                <input type="number" name="age" value="<?php echo $_SESSION['age']; ?>">
                <br>
                <label for="role">Rôle</label>
                <input type="text" name="role" value="<?php echo $_SESSION['role']; ?>">
                <br>
                <br>
                <input type="submit" name="submitUpdate" value="Modifier">
            </form> -->

        <?php


        if (isset($_POST['submitUpdate'])){
            if (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['age']) || empty($_POST['role'])){ ?>
                <p class="alert-error">Toutes les informations ont besoin d'être renseigné</p>

        <?php }

            else{
                    $_SESSION['prenom'] = $_POST['prenom'];
                    $_SESSION['nom'] = $_POST['nom'];
                    $_SESSION['age'] = $_POST['age'];
                    $_SESSION['role'] = $_POST['role'];
        ?>
        <p class="alert-success">Les données utilisateurs ont bien été mis à jour</p>

        <?php }
}
 

// *********************************************** Déconnexion ********************************************************************************************


        if (isset($_GET['page']) && $_GET['page'] == "connexion" && !empty($_SESSION)) {

            echo '<form method="POST">';
            echo '<br>';
            echo '<input type="submit" name="deconnexion" value="Déconnexion">';
            echo '</form>';
        }

    ?>
        
        <?php
            if (isset($_POST['deconnexion'])) {
            session_destroy(); ?>
            <p class="alert-deconnexion">Vous êtes maintenant déconnecté</p>
            <?php
                         header("refresh:1;http://localhost/projet%209/index.php?page=accueil");

             }
        ?>
    


</section>

</div>


</body>
</html>