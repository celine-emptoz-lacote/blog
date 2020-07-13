<?php

$id_article = $_GET['id'];

require '../../php/fonction/fonctions.php';
$bd = connexionPDO();

$requete_supprimer = $bd->prepare("DELETE FROM `articles` WHERE id = $id_article");
$requete_supprimer->execute();

header("location: ../../admin.php");

?>