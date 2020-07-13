<?php
session_start();

if (isset($_POST['modifier'])) {
   
    if (!empty($_POST['droits'])) {
        
        require '../../php/fonction/fonctions.php';
        $bd = connexionPDO();
        
        $id_droits = $_POST['droits'];
        $id_utilisateur = $_GET['id'];
        $modif_droits = $bd->prepare("UPDATE `utilisateurs` SET `id_droits`= ? WHERE id = ?");
        $modif_droits->execute(array($id_droits,$id_utilisateur));
        
        header("location: ../../admin.php");
    }
}
?>