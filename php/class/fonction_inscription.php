<?php
    class user 
        {
            private $id ='';
            public $login = '';
            public $password = '';
            public $email = '';
            public $id_droit = '';
            public $bdd = '';

            //Crée la connexion à la bdd dès que l'objet est appelé "new user"
            public function __construct($dbname)
                {
                    try
                        {
                            $bdd = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);                   
                            $this->bdd = $bdd;
                        }
                    catch(PDOException $e)//affiche une erreur si mauvais entrée de la bdd
                        {
                            $error = $e->getMessage();
                            echo $error;
                        }                    
                }
            //Ferme la connexion à la bbd
            public function __destruct()
                {
                    $this->bdd = '';
                }
            //Vérifie que le login n'est pas prit
            public function issetUser($login)
                {
                    $query_issset_user = $this->bdd->query("SELECT * FROM utilisateurs WHERE login='$login'");
                    $isset_user = $query_issset_user->fetch();

                    return $isset_user;
                }
            //Insert dans la bdd les info de l'utilisateur
            public function register($login, $password, $email)
                {                    
                    $insert_user = $this->bdd->prepare("INSERT INTO utilisateurs (login, password, email) VALUES (:login, :password, :email)");
                    $insert_user->execute([
                        'login' => $login,
                        'password' => $password,
                        'email' => $email
                    ]);                                                   
                }           
        }    
?>