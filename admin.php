<?php
session_start();
if (isset($_SESSION['user'])) {

    if($_SESSION['user']->id_droits != 1337 ) {
        $_SESSION['erreur'] = "Vous ne pouvez pas acceder à cette page !";
        header('location: profil.php');
    }
    require 'php/include/connexion.php';
    
    $recuperation_users = $bd->prepare("SELECT * FROM utilisateurs INNER JOIN droits ON utilisateurs.id_droits = droits.id");
    $recuperation_users->execute();
    $resultat_users = $recuperation_users->fetchall();
    
    
    if (isset($_GET['class'])) {
        if ($_GET['class'] == "plus" ) {
            $recuperation_articles = $bd->prepare("SELECT * FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.id_categorie = categories.id ORDER BY `date` DESC ");
            $recuperation_articles->execute();
            $resultat_recuperation_articles = $recuperation_articles->fetchall();
        }
        elseif ($_GET['class'] == "moins") {
            $recuperation_articles = $bd->prepare("SELECT * FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.id_categorie = categories.id ORDER BY `date` ASC ");
            $recuperation_articles->execute();
            $resultat_recuperation_articles = $recuperation_articles->fetchall();
        }
        else {
            $recuperation_articles = $bd->prepare("SELECT * FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.id_categorie = categories.id  ");
            $recuperation_articles->execute();
            $resultat_recuperation_articles = $recuperation_articles->fetchall();
        }
    }
    else {
        $recuperation_articles = $bd->prepare("SELECT * FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id INNER JOIN categories ON articles.id_categorie = categories.id  ");
        $recuperation_articles->execute();
        $resultat_recuperation_articles = $recuperation_articles->fetchall();
    }
}
else {
    $_SESSION['erreur'] = 'Vous devez etre connecté !';
    header("location: connexion.php");
}




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
    <title>Espace Administrateur</title>
</head>
<body>
    <header><?php include 'php/include/header.php';?></header>

    <main class="main_admin">
        <h1 class="pt-5">Espace administrateur</h1>

        <img class="img_admin" src="src/image/admin.png" alt="">

        <section>
            <h2 class="titre_admin">Gestion utilisateurs</h2>

            <table class="table1">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Droits</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 0 ; $i < COUNT($resultat_users) ; $i ++) :?>
                    <tr>
                        <td><?= $resultat_users[$i]['login'] ?></td>
                        <td><?= $resultat_users[$i]['email'] ?></td>
                        <td><?= $resultat_users[$i]['nom'] ?></td>
                        <td><a class="icon-edit" href="modification_user.php?id=<?=$resultat_users[$i][0] ?>" title="Modifier"></a> </td>
                        <td><a class="icon-trash" href="php/traitement/supprimer_user.php?id=<?= $resultat_users[$i][0] ?>" title="supprimer"></a></td>
                    </tr>
                    <?php endfor ;?>
                </tbody>
            </table>
        </section>

        <section>
            <h2 class="titre_admin">Les articles</h2>

            <table class="table2">
                <thead>
                    <tr>
                        <th>Date <a class="icon-up-micro" href="admin.php?class=plus"></a><a class="icon-down-micro" href="admin.php?class=moins"></a></th>
                        <th>Nom de l'article</th>
                        <th>Article</th>
                        <th>Auteur</th>
                        <th>Image</th>
                        <th>Catégorie</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0 ; $i<COUNT($resultat_recuperation_articles) ; $i++) :?>
                    <tr>
                        <td><?= date("d/m/Y",strtotime($resultat_recuperation_articles[$i]['date'])) ?></td>
                        <td><?= $resultat_recuperation_articles[$i]['titre'] ?></td>
                        <td><?= mb_strimwidth($resultat_recuperation_articles[$i]['article'], 0 , 50, "..." )?></td>
                        <td><?= $resultat_recuperation_articles[$i]['login'] ?></td>
                        <td><img src="php/traitement/upload/<?= $resultat_recuperation_articles[$i]['image'] ?>" alt="Image"></td>
                        <td><?= $resultat_recuperation_articles[$i]['nom'] ?></td>
                        <td><a class="icon-edit" href="modification_article.php?id=<?= $resultat_recuperation_articles[$i][0]?>" title="Modifier"></a> </td>
                        <td><a class="icon-trash" href="php/traitement/supp_article.php?id=<?= $resultat_recuperation_articles[$i][0]?>" title="supprimer"></a> </td>
                    </tr>
                    <?php endfor ;?>
                </tbody>
            
            </table>
            
            <h2 class="titre_admin">Catégories</h2>
            <div class="div_admin">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Supprimer</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i=0 ; $i <COUNT($categories) ; $i++ ):?>
                        <tr>
                            <td><?= $categories[$i]['nom'] ?></td>
                            <td><a class="icon-edit" href="modification_categorie.php?id=<?= $categories[$i]['id'] ?>" title="Modifier"></a></td>
                            <td><a class="icon-trash" href="php/traitement/supprimer_categorie.php?id=<?= $categories[$i]['id'] ?>" title="supprimer"></a></td>
                        </tr>
                        <?php endfor ;?>
                    </tbody>
                </table>
                
                <?php if (isset($_SESSION['erreur'])) { echo $_SESSION['erreur'];}?>
                <form action="php/traitement/ajout_categorie.php" method="POST">
                    <label class="d-block mb-2">Ajouter une catégorie :</label>
                    
                    <input class="d-block w-75 m-auto" type="text" id="categorie" name="categorie" placeholder="Nom de la catégorie à ajouter">

                    <input class="d-block mt-2 ml-auto mr-auto btn btn-primary" type="submit" name="Valider">
                </form>
            </div>
        </section>

        
    
    </main>

    <?php include 'php/include/footer.php' ; ?>
    
</body>
</html>