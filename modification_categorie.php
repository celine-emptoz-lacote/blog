<?php
require 'php/include/connexion.php';
$id_categorie = $_GET['id'];

$requete = $bd->prepare("SELECT * FROM categories WHERE id = $id_categorie ");
$requete->execute();
$resultat = $requete->fetch();

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
    <title>Modifier une catégorie</title>
</head>
<body>
    <header><?php include 'php/include/header.php';?></header>

    <main  class="main_admin">
        <h1>Modification de la catégorie</h1>

        <?php if (isset($_SESSION['erreur'])) { echo "<p>".$_SESSION['erreur']."</p>" ;} ?>
        <form action="php/traitement/modification_categorie.php?id=<?= $resultat['id'] ?>" method="POST" >
        
            <input type="text" name="categorie" value="<?= $resultat['nom'] ?>">

            <input type="submit" value="Modifier" name="modifier">
        
        </form>

        <a class="btn btn-danger mt-4 mb-4 ml-auto mr-auto" href="admin.php">Retour</a>
    
    </main>

    <?php include 'php/include/footer.php';?>
</body>
</html>