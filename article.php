<?php 
    session_start();
    require 'php/fonction/fonctions.php';
    $id_article = $_GET['id'];

    setlocale(LC_TIME, "fr_FR","French");

    $bd = connexionPDO();

    // $requete = $bd->prepare("SELECT * FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id WHERE articles.id = $id_article" );
    // $requete->execute();
    // $resultat = $requete->fetchall();
    $resultat = recuperation_join($bd,'articles','utilisateurs','articles.id_utilisateur','utilisateurs.id','articles.id',$id_article);
    var_dump( $resultat);

    $requete_commentaires = $bd->prepare("SELECT * FROM commentaires WHERE id_article = $id_article");
    $requete_commentaires->execute();
    $resultat_commenatires = $requete_commentaires->fetchall();

    var_dump($resultat_commenatires);
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
    <title>Document</title>
</head>
<body>

    <header><?php include 'php/include/header.php' ?></header>

    <main>
        <h1><?= $resultat['titre']?></h1>
        <p><?= $resultat['article']?></p>
        <p><em>Ecris par <?= $resultat['login'] ?> , le <?= strftime("%d %B %Y",strtotime($resultat['date'])) ?></em></p>


<!-- SI IL Y A DES COMM-->
    <?php if (!empty($resultat_commenatires)) :?>
    <div class="card">
        <div class="card-header">
        <!-- COMPTER LES COMS-->
            <h3>Commentaires</h3>
        </div>
        <div> 
        <p>com</p>  
        
        </div>
    </div> 
    <?php endif ;?>

   
        <form action="php/traitement/formulaire_commentaires.php?<?= $id_article ?>" method="POST">

            <label for="commenataire">Votre commentaire :</label>
            <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>

            <input type="submit" name="valider">
        
        </form>
    
    </main>

    <?php include 'php/include/footer.php' ?>
    
</body>
</html>