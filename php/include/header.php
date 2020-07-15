<nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav">
  <a class="navbar-brand" href="index.php" title ="Retour à l'accueil">Le Prog<span class="titre">'Blog</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>

    <!-- SI L UTILISATEUR CONNECTE -->
    <?php if (isset($_SESSION['user']->id)) :?>
        <li class="nav-item active">
            <a class="nav-link" href="profil.php">Profil</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="php/traitement/deconnexion.php">Déconnexion</a>
        </li>

        <!-- SI MODERATEUR OU ADMIN  -->
        <?php if( $_SESSION['user']->id_droits == 42 || $_SESSION['user']->id_droits == 1337 ) :?>
            <li class="nav-item active">
                <a class="nav-link" href="creer-article.php">Creer un article</a>
            </li>
        <?php endif ?>

        <?php if( $_SESSION['user']->id_droits == 1337 ) :?>
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">Espace administateur</a>
            </li>
        <?php endif ?>
        <!-- --->

        <?php else :?>
        <li class="nav-item active">
            <a class="nav-link" href="connexion.php">Connexion</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="inscription.php">Inscription</a>
        </li>
    <?php endif ;?>
    
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Les catégories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="articles.php">Tous les articles</a>
          <?php if (isset($categories))  :?>
              <?php for ($i = 0 ; $i<COUNT($categories) ; $i++) :?>
                <a class="dropdown-item" href="articles.php?categorie=<?= $categories[$i]['id']?>&p=1"><?= $categories[$i]['nom'] ?></a>
              <?php endfor ;?>
          <?php endif ;?>
           
        </div>
      </li>
      
    </ul>
  </div>
</nav>