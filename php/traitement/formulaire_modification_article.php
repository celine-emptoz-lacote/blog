<?php 
session_start();
    if (isset($_POST['valider'])) {

        require '../../php/fonction/fonctions.php';
        $bd = connexionPDO();

        $id_article = $_GET['id'];

        var_dump($_FILES['image']);
        echo "1";
        $titre = $_POST['titre'];
        $article = $_POST['article'];
        $categorie = $_POST['categorie'];

        if (!empty($titre) && !empty($article) && !empty($categorie)) {

            if (!empty($_FILES['image']['name'])) {


                $dossier = 'upload/';
                $fichier = basename($_FILES['image']['name']);
                $taille_maxi = 600000;
                $taille = filesize($_FILES['image']['tmp_name']);
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($_FILES['image']['name'], '.'); 
                //verifications
                if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                {
                    $_SESSION['erreur'] = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
                    header("location: ../../modification_article.php?id=$id_article");
                }
                if($taille>$taille_maxi)
                {
                    $_SESSION['erreur'] = 'Le fichier est trop gros...';
                    header("location: ../../modification_article.php?id=$id_article");
                }
                if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
                {
                    //On formate le nom du fichier 
                    $fichier = strtr($fichier, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                    {
                        $_SESSION['success'] = 'Upload effectué avec succès !';
                        //header("location: ../../modification_article.php?id=$id_article");
                    }
                    else //Sinon (la fonction renvoie FALSE).
                    {
                        $_SESSION['erreur'] =  'Echec de l\'upload !';
                        header("location: ../../modification_article.php?id=$id_article");
                    }
                }

                $up_article = $bd->prepare("UPDATE `articles` SET `article`=?,`id_categorie`=?,`titre`=?,`image`=? WHERE id = $id_article");
                $up_article->execute(array($article,$categorie,$titre,$fichier));
                header("location: ../../modification_article.php?id=$id_article");

               
                echo "avec photo";
            }
            else {
                echo "4";
               
                $up_article = $bd->prepare("UPDATE `articles` SET `article`=?,`id_categorie`=?,`titre`=? WHERE id = $id_article");
                $up_article->execute(array($article,$categorie,$titre));
                $_SESSION['success'] = 'Mise à jour effectuée !';
                header("location: ../../modification_article.php?id=$id_article");
              
                echo "sans photo";
            }
        }
    }

?>