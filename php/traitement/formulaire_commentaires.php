<?php 
session_start();

    
    //VERIFICATION DES CHAMPS
    if (!empty($_POST['commentaire'])) {
        require '../../php/fonction/fonctions.php';
        $bd = connexionPDO();
        $commentaire = $_POST['commentaire'];
        $id_article = $_GET['id'];
        
        $id_utilisateur = $_SESSION['user']->id;
        

        $requete_insert_commentaire = $bd->prepare("INSERT INTO `commentaires`( `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES (?,?,?,NOW())");
        $requete_insert_commentaire->execute(array($commentaire,$id_article,$id_utilisateur));
        header("location: ../../article.php?id=$id_article");
       
        
    }





?>