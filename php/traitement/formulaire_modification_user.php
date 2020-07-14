<?php
session_start();
$id_utilisateur = $_GET['id'];


if (isset($_POST['modifier'])) {
   
    if (!empty($_POST['droits'])) {
        
        require '../../php/fonction/fonctions.php';
        $bd = connexionPDO();
        
        $id_droits = $_POST['droits'];
        
        $modif_droits = $bd->prepare("UPDATE `utilisateurs` SET `id_droits`= ? WHERE id = ?");
        $modif_droits->execute(array($id_droits,$id_utilisateur));
        
        header("location: ../../admin.php");
    }
    else {
        $_SESSION['erreur'] = "Valeur incorrect";
        header("location: ../../modification_user.php?id=$id_utilisateur");
    }
}
?>