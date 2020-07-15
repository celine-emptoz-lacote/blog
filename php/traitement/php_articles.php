<?php            
    if(isset($_GET["par_page"]) && !empty($_GET["par_page"]) && $_GET["par_page"]>= 5)                   
        {
            $par_page = (int) $_GET["par_page"];
        }
    else
        {
            $par_page = 5;
        }
     
//--------------------Affiche les articles suivant la catéorie choisie
    if(isset($_GET["categorie"]) && !empty($_GET["categorie"]) && !empty($categories))
        {                                    
            $get_id_categorie = (int)$_GET["categorie"];//Impose le fait que ça doit être un entier                

            //Compte les articles de la catégorie
            $query_count_articles_cat =  $bd->query("SELECT COUNT(id) as count_articles_cat FROM articles WHERE id_categorie=$get_id_categorie");
            $count_articles_cat = $query_count_articles_cat->fetch();

            $nb_articles_cat = $count_articles_cat['count_articles_cat'];
           
            $nb_pages_cat = ceil($nb_articles_cat/$par_page); 

              //Regarde le numéro de la page
            if(isset($_GET["start"]) && $_GET["start"]>0 && $_GET["start"]<=$nb_pages_cat)
                {
                    $page = (int) strip_tags($_GET["start"]);
                }
            else
                {
                    $page = 1;
                }       
           
            $a_partir_du = (($page-1)*$par_page); //Permet de savoir à partir de quel article on commence l'affichage           

            //Récupère tous les articles liés à la catégorie, limiter à 5 par page à partir du 0 (puis 5, 10...)
            $query_categorie_articles = $bd->query("SELECT * FROM articles WHERE id_categorie=$get_id_categorie ORDER BY date DESC LIMIT $a_partir_du, $par_page");
            $categorie_articles = $query_categorie_articles->fetchAll(PDO::FETCH_ASSOC);        

            //Récupère le titre de la catégorie
            $query_titre_cat = $bd->query("SELECT nom FROM categories WHERE id=$get_id_categorie");
            $titre_cat = $query_titre_cat->fetch();            
            
            ?>
            <h1><?= $titre_cat["nom"]?></h1>
            <?php

            if(empty($categorie_articles))
                {
                    ?>
                    <p>Il n'y a pas encore d'article</p>
                    <?php
                }
            else
                {
                    foreach($categorie_articles as $article => $element)
                        {
                            ?>
                            <section class="articles">
                                <section class="titre_articles">
                                    <h2><?= $element["titre"] ?></h2>
                                </section>
                                <section class="infos_articles">
                                    <section>
                                        <img src="php/traitement/upload/<?= $element["image"] ?>" alt="photo article" class="img_article">
                                    </section>
                                    <section class="lecture_articles">
                                        <section class="texte_aticles">
                                            <p>"<?= substr($element["article"], 0, 200) ?>..."</p><!-- Limiter le nombre de caractère -->
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
                    //Pagination pour la partie articles par catégorie
                    if($nb_articles_cat >$par_page)
                        {                       
                            ?>
                             <section class="pagination"> 
                                <?php
                                if($page > 1)
                                    {
                                        ?>
                                        <a href="articles.php?start=<?= $page - 1 ?>&categorie=<?= $element['id_categorie'] ?>&par_page=<?= $par_page ?>" class="btn btn-primary">&laquo; Page précédente</a>
                                        <?php
                                    }    
                                else
                                    {
                                        ?>
                                        <p class="precedent"></p>
                                        <?php
                                    }        
                                ?>
                                <section class="pagination_chiffre">
                                <?php                    
                                for($i=1; $i<=$nb_pages_cat; $i++)//Crée les numéros pour la pagination en fonction du nombre de pages
                                    {
                                        if($i==$page)
                                            {
                                                ?>
                                                <span class="bg-primary text-white p-1"><?= $i ?></span>
                                                <?php                                                
                                            }  
                                        else if($i == 1)
                                            {
                                                ?>                         
                                                    <a href="articles.php?start=<?= $i ?>&categorie=<?= $element['id_categorie'] ?>&par_page=<?= $par_page ?>"><?= $i?></a>                     
                                                <?php
                                            }
                                        else if($i == $nb_pages_cat)
                                            {
                                                ?>                         
                                                    <a href="articles.php?start=<?= $i ?>&categorie=<?= $element['id_categorie'] ?>&par_page=<?= $par_page ?>"><?= $i?></a>                         
                                                <?php
                                            }
                                        else
                                            {                                           
                                                if($i == ($page - 1) || $i == ($page + 1))
                                                    {
                                                        ?>                         
                                                            <a href="articles.php?start=<?= $i ?>&categorie=<?= $element['id_categorie'] ?>&par_page=<?= $par_page ?>"><?= $i?></a>                         
                                                        <?php
                                                    }   
                                                if($i == ($page - 2) || $i == ($page + 2))                                         
                                                    {
                                                        echo "&nbsp...&nbsp";
                                                    }
                                            }
                                                    
                                    }     
                                ?>
                                </section>
                                <?php
                                if($page < $nb_pages_cat)
                                    {
                                        ?>
                                        <a href="articles.php?&start=<?= $page + 1 ?>&categorie=<?= $element['id_categorie'] ?>&par_page=<?= $par_page ?>" class="btn btn-primary suivant">Page suivante &raquo;</a>
                                        <?php
                                    }
                            ?>
                            </section> 
                            <?php   
                        }                         
                }                                                                          
        }

//------------------Affiche des articles sans passer par les catégories
    else 
        {                      
            //Création de la pagination
            //Compte le nombre d'articles
            $query_count_articles = $bd->query("SELECT COUNT(id) as count_articles FROM articles");
            $count_articles = $query_count_articles->fetch();     
            
            //Initialise les variables pour la pagination
            $nb_articles = $count_articles['count_articles'];         
        
            $nb_pages = ceil($nb_articles/$par_page);

             //Regarde le numéro de la page
            if(isset($_GET["start"]) && $_GET["start"]>0 && $_GET["start"]<=$nb_pages)
                {
                    $page = (int) strip_tags($_GET["start"]);
                }
            else
                {
                    $page = 1;
                }       
           
            $a_partir_du = (($page-1)*$par_page); //Permet de savoir à partir de quel article on commence l'affichage   
    
            //Récupère tous les articles limiter à 5 par page à partir du 0 (puis 5, 10...)
            $query_all_articles = $bd->query("SELECT * FROM articles ORDER BY date DESC LIMIT $a_partir_du, $par_page");           
            $all_articles = $query_all_articles->fetchAll(PDO::FETCH_ASSOC);
           
            
            ?>
            <h1>Tous les Articles</h1>
            <?php

            if(empty($all_articles))
                {
                    ?>
                    <p>Il n'y a pas encore d'article</p>
                    <?php
                }
            else
                {
                    foreach($all_articles as $article => $element)
                        {
                            ?>
                            <section class="articles">
                                <section class="titre_articles">
                                    <h2><?= $element["titre"] ?></h2>
                                </section>
                                <section class="infos_articles">
                                    <section>
                                        <img src="php/traitement/upload/<?= $element["image"] ?>" alt="photo article" class="img_article">
                                    </section>
                                    <section class="lecture_articles">
                                        <section class="texte_aticles">
                                            <p>"<?= substr($element["article"], 0, 200) ?>..."</p><!-- Limiter le nombre de caractère -->
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
                                //Affichage de la pagination pour la partie articles globale
                    if($nb_articles>$par_page)
                        {
                            ?>                                                       
                            <section class="pagination"> 
                                <?php
                                if($page > 1)
                                    {
                                        ?>
                                        <a href="articles.php?start=<?= $page - 1 ?>&par_page=<?= $par_page ?>" class="btn btn-primary">&laquo; Page précédente</a>
                                        <?php
                                    }    
                                else
                                    {
                                        ?>
                                        <p class="precedent"></p>
                                        <?php
                                    }        
                                ?>
                                <section class="pagination_chiffre">
                                <?php                    
                                for($i=1; $i<=$nb_pages; $i++)//Crée les numéros pour la pagination en fonction du nombre de pages
                                    {
                                        if($i==$page)
                                            {
                                                ?>
                                                <span class="bg-primary text-white p-1"><?= $i ?></span>
                                                <?php
                                            }  
                                        else if($i == 1)
                                            {
                                                ?>                         
                                                    <a href="articles.php?start=<?= $i ?>&par_page=<?= $par_page ?>"><?= $i?></a>                        
                                                <?php
                                            }
                                        else if($i == $nb_pages)
                                            {
                                                ?>                         
                                                    <a href="articles.php?start=<?= $i ?>&par_page=<?= $par_page ?>"><?= $i?></a>                        
                                                <?php
                                            }
                                        else
                                            {                                           
                                                if($i == ($page - 1) || $i == ($page + 1))
                                                    {
                                                        ?>                         
                                                            <a href="articles.php?start=<?= $i ?>&par_page=<?= $par_page ?>"><?= $i?></a>                         
                                                        <?php
                                                    }   
                                                if($i == ($page - 2) || $i == ($page + 2))                                         
                                                    {
                                                        echo "&nbsp...&nbsp";
                                                    }
                                            }                                                    
                                    }     
                                ?>
                                </section>
                                <?php
                                if($page < $nb_pages)
                                    {
                                        ?>
                                        <a href="articles.php?&start=<?= $page + 1 ?>&par_page=<?= $par_page ?>" class="btn btn-primary suivant">Page suivante &raquo;</a>
                                        <?php
                                    }
                            ?>
                            </section> 
                            <?php
                        }   
                }                 
        }                        
?>