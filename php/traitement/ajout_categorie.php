<?php
session_start();

    if (isset($_POST['Valider'])) {
        
        if (!empty($_POST['categorie'])) {
            echo "1";

            require '../../php/fonction/fonctions.php';
            $bd = connexionPDO();

            $categorie = $_POST['categorie'];
            $requete = $bd->prepare("INSERT INTO `categories`( `nom`) VALUES (?)");
            $requete->execute(array($categorie));
            header("location: ../../admin.php");
        }
        else {
            $_SESSION['erreur'] = "le champs ne peut pas etre vide ";
            header("location: ../../admin.php");
        }
    }
?>