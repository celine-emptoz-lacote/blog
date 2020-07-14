<?php
$bd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root', '');
//Création de la pagination
            //Compte le nombre d'articles
            $query_count_articles = $bd->query("SELECT COUNT(id) as count_articles FROM articles");
            $count_articles = $query_count_articles->fetch();     
            
            //Initialise les variables pour la pagination
            $nb_articles = $count_articles['count_articles'];         
            $par_page = 5;
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

//TEST création '...' dans la pagination
            $query_fin = $bd->query("SELECT MAX($nb_articles) FROM articles");

            $fin = $query_fin->fetch(PDO::FETCH_ASSOC);
            $autour = 2;
            $intervalle = "... /";
            $debut = 1;             
            $tab_autour = array(); 
            $html = '<div class="pagination">';
           
                
           
           
            $a_partir_du = (($page-1)*$par_page);
            if($nb_articles>$par_page)
            {
                ?>
                <section class="pagination">  
                    <?php
                for($i = $page-$autour; $i<=$nb_pages; $i++)
                    {
                        $tab_autour[] = $i;
                    }

                for($j = 1; $j <= $nb_pages; $j++)
                    {
                        if($j==$page)
                            {
                                $html .= $j.' ';
                                echo "$j /";
                            }
                        else
                            {
                                $html .= '<a href="articles.php?start=<?= $j ?>"><?= $j?></a> '; 
                                ?>                                                           
                                    <a href="articles.php?start=<?= $j ?>"><?= $j?></a> /                        
                                <?php
                            }     
                        if($j <$page && !$debut) 
                            {                                
                                echo $intervalle;
                                $debut = true;
                            }
                        elseif($j > $page && !$fin) 
                            {
                                echo $intervalle;
                                $fin = true;
                            }  
                    }
                                                          
                ?>
                </section> 
                <?php
            }
?>