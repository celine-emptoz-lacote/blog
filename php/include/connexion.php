<?php
require 'php/fonction/fonctions.php';
$bd = connexionPDO();
$categories = recuperation($bd,'nom','categories');
?>