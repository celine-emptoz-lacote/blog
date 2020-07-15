<?php 
    include 'php/traitement/php_inscription.php';
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
    <link href="src/fontello/css/fontello.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css"/> 
    <link href="src/css/styles.css" rel="stylesheet">  
    <title>Inscription</title>
</head>
<body>
    <header><?php include 'php/include/header.php';?></header>

    <main class="main_form">              
        <h1>Formulaire d'inscription</h1>

        <?php if(isset($msg_error)) { echo '<p class="alert alert-danger w-75 p-3 m-auto text-center">'.$msg_error.'</p>' ; }?></p>
        
        <section class="container mb-5 mt-5 d-flex justify-content-center">            
            <form action="" method="POST">
                <section class="form-group">
                    <label for="login" class="d-flex justify-content-center">Login :</label>
                    <input type="text" name="login" class="form-control text-center" required>
                </section>

               <section class="form-group">
                    <label for="password" class="d-flex justify-content-center">Mot de passe :</label>
                    <input type="password" name="password" class="form-control text-center" required>
               </section>

                <section class="form-group">
                    <label for="conf_password" class="d-flex justify-content-center">Confirmer mot de passe :</label>
                    <input type="password" name="conf_password" class="form-control text-center" required>
                </section>

                <section class="form-group">
                    <label for="email" class="d-flex justify-content-center">email :</label>
                    <input type="email" name="email" class="form-control text-center" required>
                </section>

                <section class="d-flex justify-content-center">
                    <input type="submit" name="valid_insc" value="Inscription" class="btn btn-primary">
                </section>               
            </form>
        </section>
    </main>

    <?php include 'php/include/footer.php';?>
</body>
</html>