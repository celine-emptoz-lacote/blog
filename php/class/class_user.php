<?php
    class user 
        {
            //Création des attributs de la classe user
            private $id ='';
            public $login = '';
            public $password = '';
            public $email = '';
            public $id_droit = '';
            public $bdd = '';
            public $msg_error = '';

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
            //Créée une session["user"] => connecte l'utilisateur
            public function connect($login, $password)     
                {                                                
                            if(!empty($this->issetUser($login)))
                                {
                                    if(password_verify($password, $this->issetUser($login)->password))
                                        {
                                            $_SESSION["user"] = $this->issetUser($login);     
                                            header("Location:index.php");                                       
                                        }    
                                    else
                                        $this->msg_error = "Mauvais mot de passe";                                                                                                                                  
                                }    
                            else
                                $this->msg_error = "Ce login n'existe pas";
                }
            public function updateUser($login, $old_password, $email, $id, $nw_password ='', $conf_password = '')
                {                
                    if(empty($this->issetUser($login)) || $login == $_SESSION["user"]->login)
                        {
                            $update_login = $this->bdd->prepare("UPDATE utilisateurs SET login=? WHERE id=?");
                            $update_login->execute([
                                $login,
                                $id
                            ]);
                            $_SESSION["user"]->login = $login;
                            echo "modifié";
                        }
                    else
                        {
                            $this->msg_error = "Ce login est déjà prit";
                        }
                }
        }    
?>