<?php
session_start();

require '../fonction/fonctions.php';

$bd = connexionPDO();

$id_utilisateur = $_GET['id'];
$supprimer_utilisateur = $bd->prepare("DELETE FROM `utilisateurs` WHERE id = $id_utilisateur");
$supprimer_utilisateur->execute();

header("location: ../../admin.php");


?>