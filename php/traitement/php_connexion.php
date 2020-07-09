<?php
    include 'php/class/class_user.php';

    session_start();       

    $user = new user('blog');

    if(isset($_SESSION["login"]))
        {
            header("Location:index.php");
        }
    else
        {                         
            if(isset($_POST["valid_co"]))
                {                              
                    $login = $_POST["login"];
                    $password = $_POST["password"];

                    $user->connect($login, $password);                                        
                }
        }
?>