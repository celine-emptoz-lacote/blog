<?php
session_start();
require 'php/include/connexion.php';

$id_utilisateur = $_GET['id'];

$infos_user = recuperation_join($bd,'utilisateurs','droits','utilisateurs.id_droits','droits.id','utilisateurs.id',$id_utilisateur);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <link href="src/fontello/css/fontello.css" rel="stylesheet">
    <link href="src/css/styles.css" rel="stylesheet">
    <title>Modification uilisateur</title>
</head>
<body>
    <header><?php include 'php/include/header.php'; ?></header>

    <main class="main_admin">


        <h1 class="text-center pb-3 pt-3">Modification des droits de <em><?= $infos_user[0]['login'] ?></em> </h1>

        <?php if (isset($_SESSION['erreur'])) { echo "<p class='alert alert-danger w-50 m-auto'>".$_SESSION['erreur']."</p>" ; } ?>
        
        <form class="text-center mt-4 mb-4  w-75 m-auto p-5 bg-white border" action="php/traitement/formulaire_modification_user.php?id=<?= $id_utilisateur?>" method="POST">
            <label class="p-1" for="login">Login :</label>
            <input class="p-1" type="text" id="login" name="login" value="<?= $infos_user[0]['login']?>" disabled>

            <select class="p-1" name="droits" id="droits">
                <option value="">Droits de l'utilisateur</option>
                <option value="1337" <?php if ($infos_user[0]['nom'] == "administrateur") { echo "selected";}?>>Administrateur</option>
                <option value="42" <?php if ($infos_user[0]['nom'] == "moderateur") { echo "selected";}?> >Modérateur</option>
                <option value="1" <?php if ($infos_user[0]['nom'] == "utilisateur") { echo "selected";}?>>Utilisateur</option>
            </select>

            <input class=" btn-primary p-1" type="submit" value="Modifier" name="modifier">
           
        </form>
        
        <a class="btn btn-danger mt-4 mb-4 ml-auto mr-auto" href="admin.php">Retour</a>
    </main>

    <?php include 'php/include/footer.php'; ?>
    
</body>
</html>
<?php unset($_SESSION['erreur']) ?>