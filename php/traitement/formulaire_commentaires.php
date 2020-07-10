<?php


if (isset($_POST['valider'])) {

    //VERIFICATION DES CHAMPS
    if (!empty($_POST['commentaire'])) {

        $commentaire = $_POST['commentaire'];
        $id_article = $_GET['id'];
        
        $id_utilisateur = $_SESSION['user']->id;
        $bd = connexionPDO();

        $requete_insert_commentaire = $bd->prepare("INSERT INTO `commentaires`( `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES (?,?,?,NOW())");
        $requete_insert_commentaire->execute(array($commentaire,$id_article,$id_utilisateur));
        
    }


}


?>