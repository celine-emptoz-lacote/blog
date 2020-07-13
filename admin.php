<?php
session_start();
require 'php/include/connexion.php';

$recuperation_users = $bd->prepare("SELECT * FROM utilisateurs INNER JOIN droits ON utilisateurs.id_droits = droits.id");
$recuperation_users->execute();
$resultat_users = $recuperation_users->fetchall();

$recuperation_articles = $bd->prepare("SELECT * FROM articles INNER JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id");
$recuperation_articles->execute();
$resultat_recuperation_articles = $recuperation_articles->fetchall();


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

    <main>
        <h1>Espace administrateur</h1>

        <section>
            <h2>Gestion utilisateurs</h2>

            <table>
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
                        <td><a href="modification_user.php?id=<?=$resultat_users[$i][0] ?>">Modifier</a> </td>
                        <td><a href="php/traitement/supprimer_user.php?id=<?= $resultat_users[$i][0] ?>">Supprimer</a></td>
                    </tr>
                    <?php endfor ;?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Les articles</h2>

            <table>
                <thead>
                    <tr>
                        <th>Nom de l'article</th>
                        <th>Article</th>
                        <th>Auteur</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0 ; $i<COUNT($resultat_recuperation_articles) ; $i++) :?>
                    <tr>
                        <td><?= $resultat_recuperation_articles[$i]['titre'] ?></td>
                        <td><?= mb_strimwidth($resultat_recuperation_articles[$i]['article'], 0 , 50, "..." )?></td>
                        <td><?= $resultat_recuperation_articles[$i]['login'] ?></td>
                        <td><img class="d-block w-25"src="php/traitement/upload/<?= $resultat_recuperation_articles[$i]['image'] ?>" alt="Image"></td>
                        <td><?= date("d/m/Y",strtotime($resultat_recuperation_articles[$i]['date'])) ?></td>
                        <td><a href="modification_article.php?id=<?= $resultat_recuperation_articles[$i][0]?>">Modifier</a> </td>
                        <td><a href="php/traitement/supp_article.php?id=<?= $resultat_recuperation_articles[$i][0]?>">Supprimer</a> </td>
                    </tr>
                    <?php endfor ;?>
                </tbody>
            
            </table>
            
            <h3>Catégorie</h3>
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
                        <td><a href="php/traitement/supprimer_categorie.php?id=<?= $categories[$i]['id'] ?>">Supprimer</a></td>
                        <td><a href="modification_categorie.php?id=<?= $categories[$i]['id'] ?>">Modifier</a></td>
                    </tr>
                    <?php endfor ;?>
                </tbody>
            </table>
            
            <?php if (isset($_SESSION['erreur'])) { echo $_SESSION['erreur'];}?>
            <form action="php/traitement/ajout_categorie.php" method="POST">
                
                <input type="text" id="categorie" name="categorie" placeholder="Nom de la catégorie à ajouter">

                <input type="submit" name="Valider">
            </form>
        </section>

        
    
    </main>

    <?php include 'php/include/footer.php' ; ?>
    
</body>
</html>
<?php unset($_SESSION['erreur']) ;?>