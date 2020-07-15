<?php 
    session_start();
    require 'php/include/connexion.php';

    setlocale(LC_TIME, "fr_FR","French");

    if (isset($_GET['id'])) {


        $id_article = $_GET['id'];


        $resultat_commentaires = recuperation_join($bd,'commentaires','utilisateurs','commentaires.id_utilisateur','utilisateurs.id','id_article',$id_article);
       
        $nb_page = ceil(count($resultat_commentaires) / 5) ;

        //verifie le get page
        if(isset($_GET["p"]) && $_GET["p"]>0 && $_GET["p"]<=$nb_page)
        {
            $page = (int) strip_tags($_GET["p"]);
        }
        else
        {   
            $page = 1;
        } 

        $com=5;
        $debut = (($page-1)*$com); 

        $pag = $bd->prepare("SELECT * FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id WHERE id_article = $id_article LIMIT $debut, $com ");
        $pag->execute();
        $res_pag = $pag->fetchall();
        

        $resultat = recuperation_join($bd,'articles','utilisateurs','articles.id_utilisateur','utilisateurs.id','articles.id',$id_article);

        if (empty($resultat)) {
            header('location: index.php');
        } 

        $articles_aleatoire = $bd->prepare("SELECT * FROM articles WHERE id != 2 ORDER BY rand() LIMIT 0,3 ");
        $articles_aleatoire->execute();
        $resultat_aleatoir = $articles_aleatoire->fetchall();


    } else {
        header('location: index.php');
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
    <title><?= $resultat[0]['titre'] ?></title>
</head>
<body>

    <header><?php include 'php/include/header.php' ?></header>

    <main>
    <?php if (isset($resultat_aleatoir)) :?>
    <section class="section_article">
        <div>
            <h1 class="text-center m-4"><?= $resultat[0]['titre']?></h1>
            <img class="d-block m-auto p-5 img_article " src="php/traitement/upload/<?=$resultat[0]['image'] ?>" alt="">
            <p class="m-3 text-justify"><?= $resultat[0]['article']?></p>
            <p class="m-3 text-right"><em>Ecris par <?= $resultat[0]['login'] ?> , le <?= strftime("%d %B %Y",strtotime($resultat[0]['date'])) ?></em></p>
        </div>
        <div class="section_article_div p-3 ">
            <h3 class="m-4">D'autre articles</h3>
            <?php for ($i=0 ; $i<COUNT($resultat_aleatoir) ; $i++) :?>
            <article class="p-4 m-2 border">
                <h5><?= $resultat_aleatoir[$i]['titre'] ?></h5> 
                <p class="text-justify"><?= mb_strimwidth($resultat_aleatoir[$i]['article'],0,200,'...') ?></p>
                <a href="article.php?id=<?= $resultat_aleatoir[$i]['id']?>">Lire la suite</a>       
            </article>
            
            <?php endfor ;?>
        </div>
    </section>
    <?php else :?>
        <section>
            <div>
                <h1 class="text-center m-4"><?= $resultat[0]['titre']?></h1>
                <img class="d-block m-auto p-5 img_article" src="php/traitement/upload/<?=$resultat[0]['image'] ?>" alt="">
                <p class="m-3"><?= $resultat[0]['article']?></p>
                <p class="m-3"><em>Ecris par <?= $resultat[0]['login'] ?> , le <?= strftime("%d %B %Y",strtotime($resultat[0]['date'])) ?></em></p>
            </div>
        </section>
    <?php endif ;?>
<!-- SI IL Y A DES COMM-->
    <?php if (!empty($resultat_commentaires)) :?>
    
    
        <!-- COMPTER LES COMS-->
        <div class="commentaires p-1 ml-4 mr-4"> 
        <h3 class="text-danger"><?= COUNT($resultat_commentaires) ?> Commentaire(s)</h3>
            <?php for ($i = 0 ; $i<COUNT($res_pag) ; $i++) :?>
                <p class="bg-light m-0 "><b><?= ucfirst($res_pag[$i]['login']) ?></b> , le <?=strftime("%d %B %Y",strtotime($res_pag[$i]['date'])) ?></p> 
                <p><?= $res_pag[$i]['commentaire'] ?></p> 
            <?php endfor ;?>
        </div>
        
        <!-- PAGINATION COMM -->
        
            <div class="text-center m-2">
            
            <?php for($i= 1 ; $i < $nb_page +1; $i++) :?>
                <?php if ($page== $i) :?>
                <a class="bg-primary text-white p-1" href="article.php?id=<?= $_GET['id']?>&p=<?=$i?>"><?= $i ?></a>
                <?php else :?>
                    <a  href="article.php?id=<?= $_GET['id']?>&p=<?=$i?>"><?= $i ?></a>
                <?php endif ;?>
                <?php $com = $com + 5 ; ?>                
            <?php endfor ;?>
            </div>
      
    <?php endif ;?>

        <!-- SI UTILISATEUR CONNECTE  -->
        <?php if(isset($_SESSION["user"]->id)) :?>

        <form action="php/traitement/formulaire_commentaires.php?id=<?= $_GET['id'] ?>" method="POST" class="m-4"> 
            <div class="form-group">
                <label for="commentaire">Votre commentaire :</label>
                <textarea name="commentaire" id="commentaire" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <input type="submit" name=" valider " class="btn btn-danger d-block m-auto  p-2 ">
            
        
        </form>
        <?php endif ;?>
    </main>

    <?php include 'php/include/footer.php' ?>
    
</body>
</html>