<?php include 'php/traitement/php_profil.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">    
    <title>Mon compte</title>
</head>
<body>
    <!-- <header><?php //include 'php/include/header.php';?></header> -->

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

    <?php //include 'php/include/footer.php';?>
</body>
</html>