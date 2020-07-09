<?php    
    include 'php/class/class_user.php';

    session_start();

    $user = new user('blog');

    if(isset($_SESSION["id"]))
        {
            header("Location:index.php");
        }
    else
        {
            if(isset($_POST["valid_insc"]) && !empty($_POST["login"]) && !empty($_POST["password"]) && !empty($_POST["conf_password"]) && !empty($_POST["email"]))
                {
                    $login = $_POST["login"];
                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $email = $_POST["email"];            
        
                    if(empty($user->issetUser($login)))//Appel la fonction dans la classe user => vérifie que le login n'existe pas
                        {
                            if($_POST["password"] == $_POST["conf_password"])
                                {
                                    if(filter_var($email, FILTER_VALIDATE_EMAIL))//Vérifie que l'email est bien au format mail
                                        {                                                                      
                                            $user->register($login, $password, $email);//Insert l'utilisateur dans la BDD                                                            
                                            header("Location:connexion.php");
                                        }      
                                    else
                                        {
                                            $msg_error = "email mauvais format";                                     
                                        }                      
                                }   
                            else
                                {
                                    $msg_error = "les mots de passe ne correspondent pas";                            
                                }     
                        }   
                    else
                        {
                            $msg_error = "login existe déjà";                    
                        }     
                }                           
        }        
?>    