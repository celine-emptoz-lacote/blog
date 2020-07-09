<?php 
    session_start();
    require 'php/fonction/fonctions.php';
    $id_article = $_GET['id'];

    setlocale(LC_TIME, "fr_FR","French");

    $bd = connexionPDO();
    $resultat = recuperation_join($bd,'articles','utilisateurs','articles.id_utilisateur','utilisateurs.id','articles.id',$id_article);

    $resultat_commentaires = recuperation_join($bd,'commentaires','utilisateurs','commentaires.id_utilisateur','utilisateurs.id','id_article',$id_article);

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
    <title><?= $resultat[0]['titre'] ?></title>
</head>
<body>

    <header><?php include 'php/include/header.php' ?></header>

    <main>
        <h1><?= $resultat[0]['titre']?></h1>
        <p><?= $resultat[0]['article']?></p>
        <p><em>Ecris par <?= $resultat[0]['login'] ?> , le <?= strftime("%d %B %Y",strtotime($resultat[0]['date'])) ?></em></p>


<!-- SI IL Y A DES COMM-->
    <?php if (!empty($resultat_commentaires)) :?>
    
        <div>
        <!-- COMPTER LES COMS-->
            <h3><?= COUNT($resultat_commentaires) ?> Commentaire(s)</h3>
        </div>
        <div> 
            <?php for ($i = 0 ; $i<COUNT($resultat_commentaires) ; $i++) :?>
                <p><?= $resultat_commentaires[$i]['commentaire'] ?></p> 
                <p>Par : <b><?= ucfirst($resultat_commentaires[$i]['login']) ?></b> , le <?=strftime("%d %B %Y",strtotime($resultat_commentaires[$i]['date'])) ?></p> 
            <?php endfor ;?>
        </div>
    
    <?php endif ;?>

        <!-- SI UTILISATEUR CONNECTE  -->
        <?php if(isset($_SESSION["user"]->id)) :?>
        <form action="php/traitement/formulaire_commentaires.php?id=<?= $id_article ?>" method="POST">

            <label for="commenataire">Votre commentaire :</label>
            <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>

            <input type="submit" name="valider">
        
        </form>
        <?php endif ;?>
    </main>

    <?php include 'php/include/footer.php' ?>
    
</body>
</html>