<?php 
 $query_count_articles =  $bd->query("SELECT COUNT(id) as count_articles FROM articles");
 $count_articles = $query_count_articles->fetch();

 $nb_articles = $count_articles['count_articles'];

 if($nb_articles>5)
    {
        if(isset($_GET["categorie"]))
            {
                ?>
                <form action="" method="GET">
                <section class="par_page">
                    <label for="par_page">Nombre d'articles par page</label>
                    <select name="par_page" id="par_page">
                                    
                        <option value="5"
                            <?php 
                                if($par_page == 5)
                                    {
                                        ?>
                                        selected
                                        <?php
                                    }
                                    ?>                    
                        >5</option>
                        <option value="10"
                            <?php 
                                if($par_page == 10)
                                    {
                                        ?>
                                        selected
                                        <?php
                                    }
                                    ?>                    
                        >10</option>
                        <option value="15"
                            <?php 
                                if($par_page == 15)
                                    {
                                        ?>
                                        selected
                                        <?php
                                    }
                                    ?>                    
                        >15</option>
                        <option value="20"
                            <?php 
                                if($par_page == 20)
                                    {
                                        ?>
                                        selected
                                        <?php
                                    }
                                    ?>                    
                        >20</option>
                    </select>
                    <input type="submit" value="Afficher" name="afficher">
                </section>
            </form>      
            <?php          
            }
        else
            {
                ?>
                <form action="" method="GET">
                <section class="par_page">
                    <label for="par_page">Nombre d'articles par page</label>
                    <select name="par_page" id="par_page">
                                    
                        <option value="5"
                            <?php 
                                if($par_page == 5)
                                    {
                                        ?>
                                        selected
                                        <?php
                                    }
                                    ?>                    
                        >5</option>
                        <option value="10"
                            <?php 
                                if($par_page == 10)
                                    {
                                        ?>
                                        selected
                                        <?php
                                    }
                                    ?>                    
                        >10</option>
                        <option value="15"
                            <?php 
                                if($par_page == 15)
                                    {
                                        ?>
                                        selected
                                        <?php
                                    }
                                    ?>                    
                        >15</option>
                        <option value="20"
                            <?php 
                                if($par_page == 20)
                                    {
                                        ?>
                                        selected
                                        <?php
                                    }
                                    ?>                    
                        >20</option>
                    </select>
                    <input type="submit" value="Afficher" name="afficher">
                </section>
            </form>      
            <?php          
            }
    }
?>