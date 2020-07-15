<?php
    session_start();
    require 'php/include/connexion.php';

    $requete_recuperation_articles = $bd->prepare("SELECT * FROM articles ORDER BY `date` DESC LIMIT 3 " );
    $requete_recuperation_articles->execute();
    $resultat_articles = $requete_recuperation_articles->fetchall();
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

    <title>Accueil</title>
</head>
<body>
    <header><?php include 'php/include/header.php' ?></header>

    <main>
            <?php if (isset($_SESSION['erreur'])) { echo $_SESSION['erreur']; } ?>
            <h1 class="titre_h1_index">Prog<span class="titre">'Blog</span></h1>
            <h3 >Le blog sur la programmation</h3>
            <div class="div_index">
                <p>Vous êtes débutant en Programmation, en Hacking ou en informatique de façon générale ? Vous souhaitez apprendre la programmation ? Ce blog  est fait pour vous.</p>
                <p>Nous allons voir ensemble les concepts de programmation et les systèmes se cachant derrière les applications et sites web que vous utilisez tout les jours.</p>
                <p>Si vous bloquez sur un concept de programmation, vous trouverez probablement une réponse sur ce site. Nous publions des articles très régulièrement. Ceux-ci ont pour objectif de répondre à une question ou de résoudre un problème que vous pouvez rencontrer.</p>
            </div>
           
            <section class="section_index bg-light" >
                <?php if(isset($resultat_articles)) : ?>
                    <?php for ($i=0 ; $i<COUNT($resultat_articles) ; $i++) :?>
                        <div class="card_index">
                            <h4 ><?= $resultat_articles[$i]['titre'] ?></h4>
                            <img src="php/traitement/upload/<?= $resultat_articles[$i]['image'] ?>" alt="Image de l'article">
                            <p><?= mb_strimwidth($resultat_articles[$i]['article'],0,300,'...') ?></p>
                            <a href="article.php?id=<?= $resultat_articles[$i]['id'] ?>&p=1">Lire la suite</a>
                        </div>
                    <?php endfor ;?>
                <?php endif ;?>                
            </section>
            <section id="bouton_index">
                <a href="articles.php" class="btn btn-primary">Voir plus</a>
            </section>            
    </main>

    <?php include 'php/include/footer.php' ?>
</body>
</html>
<?php unset($_SESSION['erreur']) ; ?>