<?php
session_start();
require 'php/include/connexion.php';

$id_utilisateur = $_GET['id'];

$infos_user = recuperation_join($bd,'utilisateurs','droits','utilisateurs.id_droits','droits.id','utilisateurs.id',$id_utilisateur);
var_dump($infos_user);

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

    <main>
        <form action="php/traitement/formulaire_modification_user.php?id=<?= $id_utilisateur?>" method="POST">
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" value="<?= $infos_user[0]['login']?>" disabled>

            <select name="droits" id="droits">
                <option value="">Droits de l'utilisateur</option>
                <option value="1337" <?php if ($infos_user[0]['nom'] == "administrateur") { echo "selected";}?>>Administrateur</option>
                <option value="42" <?php if ($infos_user[0]['nom'] == "moderateur") { echo "selected";}?> >Modérateur</option>
                <option value="1" <?php if ($infos_user[0]['nom'] == "utilisateur") { echo "selected";}?>>Utilisateur</option>
            </select>

            <input type="submit" value="Modifier" name="modifier">
        </form>
    </main>

    <?php include 'php/include/footer.php'; ?>
    
</body>
</html>