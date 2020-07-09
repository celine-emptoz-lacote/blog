<?php 
    include 'php/traitement/php_profil.php';     
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="src/fontello/css/fontello.css" rel="stylesheet">
    <link href="src/css/styles.css" rel="stylesheet">
    <title>Mon compte</title>
</head>
<body>
    <header><?php include 'php/include/header.php';?></header>

    <main>
        <form action="" method="POST">
            <label for="login">Login :</label>
            <input type="text" name="login" value="<?= $_SESSION['user']->login ?>" required>

            <label for="old_password">Mot de passe actuel :</label>
            <input type="password" name="old_password" required>

            <label for="nw_password">Mot de passe :</label>
            <input type="password" name="nw_password">

            <label for="conf_password">Confirmer mot de passe :</label>
            <input type="password" name="conf_password">

            <label for="email">email :</label>
            <input type="email" name="email" value="<?=$_SESSION['user']->email ?>" required>

            <input type="submit" name="valid_modif" value="Modifier">

            <?php
                if(!empty($user->msg_error))
                    {
            ?>
                        <p class="msg_error">
            <?php
                        echo $user->msg_error;
            ?>
                        </p>
            <?php
                    }                   
                if(!empty($user->msg_valid))
                    {
            ?>
                        <p class="msg_error">
            <?php
                        echo $user->msg_valid;
            ?>
                        </p>
            <?php
                    }
            ?>            
        </form>
    </main>

    <?php include 'php/include/footer.php';?>
</body>
</html>