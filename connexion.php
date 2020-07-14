<?php 
    include 'php/traitement/php_connexion.php'; 
    require 'php/include/connexion.php';  
     
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <link href="src/fontello/css/fontello.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css"/>  
    <link href="src/css/styles.css" rel="stylesheet">  
    <title>Connexion</title>
</head>
<body>
    <header><?php include 'php/include/header.php';?></header>

    <main>

        <?php if (isset($_SESSION['erreur'])) { echo "<p class='alert alert-danger w-50 m-auto' >".$_SESSION['erreur']."</p>" ; }?>

        <h1>Formulaire de Connexion</h1>
        <form action="" method="POST">
            <label for="login" name="login">Login :</label>
            <input type="text" name="login" required>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>

            <input type="submit" name="valid_co" value="Connexion">

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
            ?>
        </form>
    </main>

    <?php include 'php/include/footer.php' ?>
</body>
</html>

<?php unset($_SESSION['erreur']) ?>