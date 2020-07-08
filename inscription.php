<?php include 'php/traitement/php_inscription.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="src/css/style.css"/>    
    <title>Inscription</title>
</head>
<body>
    <?php //include 'php/include/header.php';?>

    <main>        
        <h1>Formulaire d'inscription</h1>
        <form action="" method="POST">
            <label for="login">Login :</label>
            <input type="text" name="login" required>

            <label for="password">Mot de passe :</label>
            <input type="text" name="password" required>

            <label for="conf_password">Confirmer mot de passe :</label>
            <input type="text" name="conf_password" required>

            <label for="email">email :</label>
            <input type="email" name="email" required>

            <input type="submit" name="valid_insc" value="Inscription">

            <?php
                if(isset($msg_error))
                    {
            ?>
                        <p class="msg_error">
            <?php
                        echo $msg_error;
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