<?php     
    require 'php/include/connexion.php';  
    
    //Création de la pagination
    //Compte le nombre d'articles
    $query_count_articles = $bd->query("SELECT COUNT(id) as count_articles FROM articles");
    $count_articles = $query_count_articles->fetch();     
    
    //Initialise les variables pour la pagination
    $nb_articles = $count_articles['count_articles'];     
    $par_page = 5;    
    $nb_pages = ceil($nb_articles/$par_page);        
    
    //Regarde le numéro de la page
    if(isset($_GET["p"]) && $_GET["p"]>0 && $_GET["p"]<=$nb_pages)
        {
            $page = (int) strip_tags($_GET["p"]);
        }
    else
        {
            $page = 1;
        }       

    $a_partir_du = (($page-1)*$par_page); //Permet de savoir à partir de quel article on commence l'affichage
        

    

    function affichageArticles($categories, $a_partir_du, $par_page, $bd)
        {   
            if(isset($_GET["categorie"]) && !empty($_GET["categorie"]) && !empty($categories))
                {
                    $get_id_categorie = $_GET["categorie"];
                    //Récupère tous les articles liés à la catégorie, limiter à 5 par page à partir du 0 (puis 5, 10...)
                    $query_categorie_articles = $bd->query("SELECT * FROM articles WHERE id_categorie=$get_id_categorie ORDER BY date DESC LIMIT $a_partir_du, $par_page");
                    $categorie_articles = $query_categorie_articles->fetchAll(PDO::FETCH_ASSOC); 

                    var_dump($categorie_articles);                    
                }
            else 
                {
                    //Récupère tous les articles limiter à 5 par page à partir du 0 (puis 5, 10...)
                    $query_all_articles = $bd->query("SELECT * FROM articles ORDER BY date DESC LIMIT $a_partir_du, $par_page");
                    $all_articles = $query_all_articles->fetchAll(PDO::FETCH_ASSOC);    

                    foreach($all_articles as $article => $element)
                        {
                            ?>
                            <section class="articles">
                                <section class="titre_articles">
                                    <h1><?= $element["titre"] ?></h1>
                                </section>
                                <section class="infos_articles">
                                    <section>
                                        <img src="php/traitement/upload/<?= $element["image"] ?>" alt="photo article" class="img_article">
                                    </section>
                                    <section class="lecture_articles">
                                        <section class="texte_aticles">
                                            <p><?= substr($element["article"], 0, 200) ?>...</p><!-- Limiter le nombre de caractère -->
                                            <p><a href="article.php?id=<?= $element["id"] ?>&p=1">Lire la suite...</a></p>
                                        </section>
                                        <section class="date_articles">
                                            <img src="src/image/calendar.png" alt="logo calendar"><?php echo date('d-m-Y', strtotime($element["date"])); ?>
                                        </section>
                                    </section>
                                </section>
                            </section>
                            <?php
                        }
                }            
        }
    
    function pagination($nb_pages, $page)
        {
             //RAJOUTER CONDITIONS ----- Génère la pagination en bas de page
             for($i=1; $i<=$nb_pages; $i++)
             {
                 if($i==$page)
                     {
                         echo "$i /";
                     }
                 else
                     {
                         ?>                         
                            <a href="articles.php?p=<?= $i ?>"><?= $i?></a> /                        
                         <?php
                     }                    
             }
        }    
?>