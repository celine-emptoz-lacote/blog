<?php
    require 'php/class/class_user.php';

    session_start();       

    $user = new user('blog');

    if(isset($_SESSION["user"]))
        {
            header("Location:index.php");
        }
    else
        {                         
            if(isset($_POST["valid_co"], $_POST["login"], $_POST["password"]) && !empty($_POST["login"]) && !empty($_POST["password"]))
                {                              
                    $login = $_POST["login"];
                    $password = $_POST["password"];

                    $user->connect($login, $password);                                        
                }
        }
?>