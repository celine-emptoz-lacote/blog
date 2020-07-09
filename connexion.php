<?php include 'php/traitement/php_connexion.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" href="src/css/style.css"/>   
    <title>Connexion</title>
</head>
<body>
    <?php //include 'php/include/header.php';?>

    <main>
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

    <?php //include 'php/include/footer.php';?>
</body>
</html>