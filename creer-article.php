<?php
    session_start();
    require 'php/include/connexion.php';

    if ($_SESSION['user']->id_droits != 1337 && $_SESSION['user']->id_droits != 42  ) {
        $_SESSION['erreur'] = "Vous n'avez pas les droits necessaire pour acceder à cette page";
        header('location: index.php');
    }

    $requete = $bd->prepare("SELECT * FROM categories");
    $requete->execute();
    $resultat = $requete->fetchall();

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
    <link href="src/fontello/css/fontello.css" rel="stylesheet">
    <link href="src/css/styles.css" rel="stylesheet">
    <title>Creation d'article</title>
</head>
<body>

    <header><?php include 'php/include/header.php' ?></header>
  
    <main>
        <p><?php if(isset($_SESSION['erreur'])) { echo $_SESSION['erreur'] ; }?></p>
        <p><?php if(isset($_SESSION['success'])) { echo $_SESSION['success'] ; }?></p>

        <form action="php/traitement/formulaire_creer_article.php" method="POST" enctype="multipart/form-data">

            <label for="titre">Titre de l'article :</label>
            <input type="text" id="titre" name="titre">

            <label for="image">Votre image : </label>
            <input type="file" id="image" accept=".jpg,.jpeg,.png,.gif" name="image">
             <!-- On limite le fichier -->
            <input type="hidden" name="MAX_FILE_SIZE" value="100000">

            <label for="categorie">Choisir la catégorie : </label>
            <select name="categorie" id="categorie">
                <option value="">--Choisir une option--</option>
                <?php for($i=0; $i<COUNT($resultat) ; $i++) : ?>
                    <option value="<?= $resultat[$i]['id'] ?>"> <?= $resultat[$i]['nom'] ?> </option>
                <?php endfor ?>
                
            </select>

            <label for="article">Texte de votre article :</label>
            <textarea name="article" id="article" cols="30" rows="10"></textarea>  

            <input type="submit" name="valider">
            
                  
        </form>
        
    </main>

    <?php include 'php/include/footer.php' ?>
    
</body>
</html>

<?php unset($_SESSION['success'], $_SESSION['erreur']); ?>