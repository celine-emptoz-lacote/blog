<?php
    require_once 'php/fonction/fonctions.php';

    $bdd = connexionPDO();
    //Compte le nombre d'articles
    $query_count_articles = $bdd->query("SELECT COUNT(id) as count_articles FROM articles");
    $count_articles = $query_count_articles->fetchAll(); 
    
    $nb_articles = $count_articles[0]['count_articles'];     
    $par_page = 5;    
    $nb_pages = ceil($nb_articles/$par_page);        
    
    if(isset($_GET["p"]) && $_GET["p"]>0 && $_GET["p"]<=$nb_pages)
        {
            $page = $_GET["p"];
        }
    else
        {
            $page = 1;
        }       

    $a_partir_du = (($page-1)*$par_page); 
    
    //Récupère tous les articles limiter à 5 par page à partir du 0 (puis 5, 10...)
    $query_all_articles = $bdd->query("SELECT * FROM articles ORDER BY date DESC LIMIT $a_partir_du, $par_page");
    $all_articles = $query_all_articles->fetchAll(PDO::FETCH_ASSOC);    
    
    

    var_dump($all_articles);
?>