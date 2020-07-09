<?php
    require 'php/class/class_user.php';

    session_start();

    $user = new user('blog');

    if(!isset($_SESSION["user"]))
        {
            header("Location:index.php");
        }
    else
        {
            if(isset($_POST["valid_modif"], $_POST["login"], $_POST["old_password"], $_POST["email"]))
                {                   
                    if(password_verify($_POST["old_password"], $_SESSION["user"]->password))
                        {                           
                            $login = $_POST["login"];                           
                            $email = $_POST["email"];
                            $nw_password = $_POST["nw_password"];
                            $conf_password = $_POST["conf_password"];
                            $id = $_SESSION["user"]->id;

                            $user->updateUser($login, $email, $id, $nw_password, $conf_password);
                        }
                    else
                        {
                            echo $msg_error_mdp ="Ce n'est pas le bon mot de passe";
                        }
                }
        }
?>