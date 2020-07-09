<?php
    session_start();
    require 'php/fonction/fonctions.php';

    $bd = connexionPDO();


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
    <link href="src/fontello/css/fontello.css" rel="stylesheet">
    <link href="src/css/styles.css" rel="stylesheet">

    <title>Accueil</title>
</head>
<body>
    <header><?php include 'php/include/header.php' ?></header>

    <main>

            <h1>TITRE</h1>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quod quidem at rerum accusantium quis voluptatum. Numquam sunt magni, consequuntur, illum itaque iusto iure aperiam facere, odio qui maiores architecto?</p>

            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. In aliquid accusamus sequi natus ipsa enim id ex voluptate quaerat aliquam explicabo facilis ab velit, harum laboriosam itaque. Non, sint magnam?Veniam reiciendis, perferendis vero nulla sapiente ipsum obcaecati voluptate. Hic nisi ab corporis, magni labore quo at eveniet harum placeat. Dolorem dolore nemo facilis voluptatibus impedit, assumenda libero. Tempora, esse.</p>

            <section class="section_index">
                <?php if(isset($resultat_articles)) : ?>
                    <?php for ($i=0 ; $i<COUNT($resultat_articles) ; $i++) :?>
                        <div class="card_index">
                            <h2><?= $resultat_articles[$i]['titre'] ?></h2>
                            <p><?= mb_strimwidth($resultat_articles[$i]['article'],0,300,'..') ?></p>
                            <a href="article.php?id=<?= $resultat_articles[$i]['id'] ?>">Lire la suite</a>
                        </div>
                    <?php endfor ;?>
                <?php endif ;?>
                


            </section>

    </main>

    <?php include 'php/include/footer.php' ?>
</body>
</html>