<?php

session_start();

require '../../php/fonction/fonctions.php';

$bd = connexionPDO();

$id_categorie = $_GET['id'];

$requete = $bd->prepare("DELETE FROM `categories` WHERE id = $id_categorie ");
$requete->execute();

header("location: ../../admin.php");

?>