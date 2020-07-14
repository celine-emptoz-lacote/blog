<?php session_start();
require '../../php/fonction/fonctions.php';
$bd = connexionPDO();

if (isset($_POST['valider'])) {

    var_dump($_POST);
    var_dump($_FILES);
    
    if (!empty($_POST['titre']) && !empty($_POST['categorie']) && !empty($_POST['article']) && !empty($_FILES) ) {
        
        
            $titre = $_POST['titre'];
            $categorie = $_POST['categorie'];
            $article = $_POST['article'];
            $id_utilisateur = $_SESSION['user']->id;


            $dossier = 'upload/';
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 1000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['image']['name'], '.'); 
            //verifications
            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {
                $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
            }
            if($taille>$taille_maxi)
            {
                $erreur = 'Le fichier est trop gros...';
                
            }
            if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
                //On formate le nom du fichier 
                $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    $_SESSION['success'] = 'Upload effectué avec succès !';
                   
                    $requete = $bd->prepare("INSERT INTO `articles`( `article`, `id_utilisateur`, `id_categorie`, `date`, `titre`,`image`) VALUES (?,?,?,NOW(),?,?)");
                    $requete->execute(array($article,$id_utilisateur,$categorie,$titre,$fichier));
                    
                    header('location: ../../creer-article.php');
                }
                else 
                {
                    $_SESSION['erreur'] =  'Echec de l\'upload !';
                    header('location: ../../creer-article.php');
                }
            }
            else {
                $_SESSION['erreur'] = $erreur;
                header("location: ../../creer-article.php");

            }
      


        
        

        
    }
   
}

?>