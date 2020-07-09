<?php
session_start();

if (isset($_POST['valider'])) {

    //VERIFICATION DES CHAMPS
    if (!empty($_POST['commenatire'])) {

        $commentaire = $_POST['commentaire'];
        $id_article = $_GET['id'];
        $id_utilisateur = $_SESSION['id'];
        $bd = connectionPDO();

        $requete_insert_commentaire = $bd->prepare("INSERT INTO `commentaires`( `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES (?,?,?,NOW())");
        $requete_insert_commentaire->execute(array($commentaire,$id_article,$id_utilisateur));
        header('location: article.php?id=$id_utilisateur');
    }


}


?>