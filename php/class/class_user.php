<?php
    class user 
        {
//----------Création des attributs de la classe user           
            public $bdd = '';
            public $msg_error = '';

//----------Crée la connexion à la bdd dès que l'objet est appelé "new user"
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

//----------Ferme la connexion à la bbd
            public function __destruct()
                {
                    $this->bdd = '';
                }

//----------Vérifie que le login n'est pas prit
            public function issetUser($login)
                {
                    $query_issset_user = $this->bdd->query("SELECT * FROM utilisateurs WHERE login='$login'");
                    $isset_user = $query_issset_user->fetch();

                    return $isset_user;
                }

//----------Insert dans la bdd les info de l'utilisateur
            public function register($login, $password, $email)
                {                    
                    $insert_user = $this->bdd->prepare("INSERT INTO utilisateurs (login, password, email) VALUES (:login, :password, :email)");
                    $insert_user->execute([
                        'login' => $login,
                        'password' => $password,
                        'email' => $email
                    ]);                                                   
                }      

//----------Créée une session["user"] => connecte l'utilisateur
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

//----------Met à jour les données de l'utilisateur
            public function updateUser($login, $old_password, $email, $id, $nw_password ='', $conf_password = '')
                {              
                    //Met à jour le login de l'utilisateur  
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
                    //Met à jour l'email de l'utilisateur 
                    if(empty($this->issetUser($email)) || $email == $_SESSION["user"]->email)
                        {
                            $update_email = $this->bdd->prepare("UPDATE utilisateurs SET email=? WHERE id=?");
                            $update_email->execute([
                                $email,
                                $id
                            ]);
                            $_SESSION["user"]->email = $email;
                            echo "modifié";
                        }
                    else
                        {
                            $this->msg_error = "Cet email existe déjà";
                        }
                    //Met à jour le password de l'utilisateur
                    if(isset($nw_password) && !empty($nw_password))
                        {
                            if($nw_password == $conf_password)
                                {
                                    $hash_nw_password = password_hash($nw_password, PASSWORD_DEFAULT);

                                    $update_password = $this->bdd->prepare("UPDATE utilisateurs SET password=? WHERE id=?");
                                    $update_password->execute([
                                        $hash_nw_password,
                                        $id
                                    ]);
                                    $_SESSION["user"]->password = $hash_nw_password;
                                    echo "modifié";
                                }
                            else
                                {
                                    $this->msg_error = "Les mots de passe ne correspondent pas";
                                }
                        }                    
                }
        }    
?>