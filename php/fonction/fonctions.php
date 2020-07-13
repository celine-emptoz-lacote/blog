<?php

function connexionPDO() {
    try {
        $bd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root', '');
    } catch (PDOException $e) {
        echo 'Échec de la connexion : ' . $e->getMessage();
        exit;
    }
    return $bd;
} 

function recuperation($base,$selection,$table) {
    $requete = $base->prepare("SELECT $selection FROM $table" );
    $requete->execute();
    $resultat = $requete->fetchall();

    return $resultat ;
}

function recuperation_join($base,$table,$table2,$table_join1,$table_join2,$parametre2,$parametre3){
    $requete = $base->prepare("SELECT * FROM $table INNER JOIN $table2 ON $table_join1 = $table_join2 WHERE $parametre2 = ?");
    $requete->execute(array($parametre3));
    $resultat = $requete->fetchall();
    return $resultat;
}







?>