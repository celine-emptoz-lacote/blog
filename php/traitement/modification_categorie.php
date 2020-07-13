<?php

if (isset($_POST['modifier'])) {

    require '../../php/fonction/fonctions.php';

    $bd = connexionPDO();
    $id_categorie = $_GET['id'];

    if(!empty($_POST['categorie'])) {
        echo "1";
        $categorie = $_POST['categorie'];

        $up_categorie = $bd->prepare("UPDATE `categories` SET `nom`= ? WHERE id = $id_categorie ");
        $up_categorie->execute(array($categorie));
        header("location: ../../admin.php");
    }

}
?>