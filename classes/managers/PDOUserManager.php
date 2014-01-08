<?php

require_once("PDOManager.php");
require_once(__DIR__."/../entities/User.class.php");
require_once(__DIR__."/../APIFB/src/facebook.php");



class PDOUserManager
{

    private $message;

    public function getMessage()
    {
        return $this->message;
    }

    public function authentication($email, $password){

            $PDOManager = new PDOManager;
            $pdo = $PDOManager->newPdo();

            $query = $pdo->prepare("SELECT * FROM users WHERE email = ? ");
            $query->execute(array($email));
            $data = $query->fetchAll();

            if(count($data) == 0){
                $this->message = "Adresse email incorrecte";
            }
            else{
                $row = $data[0];

                if(sha1($password) != $row["password"]){
                    $this->message = "Mot de passe incorrecte";

                }
                else{



                    $user = new User($row["id"], $row["pseudo"], $row["email"], $row["password"], $row["date_registration"], $row["facebook_id"], $row["img_url"]);
                    header("location: index.php");
                    return $user;



                }
            }
    }





   public function registration($pseudo, $email, $password, $confirmation){



           $PDOManager = new PDOManager;
           $pdo = $PDOManager->newPdo();

            $img_url = "bootstrap/img/user-icon.png";

           if(empty($pseudo)||empty($email)||empty($password)||empty($confirmation)){

           }
           elseif(!preg_match("/^([a-zA-Z0-9_]{4,16})$/", $pseudo) )
           {
               $this->message = "Votre Pseudo doit comporter entre 4 et 16 caracteres";
           }
           elseif(!preg_match("/^[a-zA-Z0-9_]{4,}$/", $password))
           {
               $this->message = "Votre mot de passe doit contenir au moins 4 caracteres";
           }
           elseif($password != $confirmation)
           {
               $this->message = "Confirmation de votre mot de passe incorrecte";
           }
           elseif(!preg_match("/\A([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})\z/i", $email)){

           }
           else
           {
               $query = $pdo->prepare("SELECT pseudo, email FROM users WHERE pseudo = :pseudo or email = :email ");
               $query->execute(array(
                   'pseudo' => $pseudo,
                   'email' => $email
               ));

               $result = $query->fetchAll();


               if (count($result) > 0) {

                   foreach ($result as $row) {
                       if ($pseudo == $row["pseudo"]) {
                           $this->message = "Le nom d'utilisateur est deja utilise";
                       }
                       elseif ($email == $row["email"]) {
                           $this->message = "L'adresse e-mail est deja utilisee";
                       }
                   }
               }
               else
               {
                   $req = $pdo->prepare( "INSERT INTO users(pseudo, password, email, register_date, img_url) VALUES(:pseudo, :password, :email, NOW(), :img_url)");
                   $req->execute(array(
                       'pseudo' => strtolower($pseudo),
                       'password' => sha1($password),
                       'email' => $email,
                       'img_url' => $img_url
                   ));

                   $this->message = "Le compte utilisateur à bien été crée";

               }

           }
       }

    public function fbConnect(){
        $PDOManager = new PDOManager;
        $pdo = $PDOManager->newPdo();

        $facebook = new Facebook(array(
            'appId' => '177799449032465',
            'secret' => 'f42055800d91cf1902d4c4090b5fb36f'
        ));

        $user = $facebook->getUser();

        if(empty($user)){
            header('location:'.$facebook->getLoginUrl(array(
                'locale' => 'fr_FR'
            )));
        }
        else{
            $me = $facebook->api('/me');
        }

        if(isset($me)){
            $fql = "SELECT uid,name,pic_big FROM user WHERE uid = $user";
            $param = array(
                'method' => 'fql.query',
                'query' => $fql,
                'callback' => ''
            );

            $fb = $facebook->api($param);
            $fb = $fb[0];


            $query = $pdo->prepare("SELECT * FROM users WHERE facebook_id = :fb_id");
            $query->execute(array(
                'fb_id' => $user
            ));

            $data = $query->fetch(PDO::FETCH_ASSOC);

            if(empty($data)){
                $pseudo = $fb['name'];
                $password = sha1(uniqid());
                $img_url = $fb['pic_big'];
                $req = $pdo->prepare("INSERT INTO users(pseudo, password, facebook_id, register_date, img_url) VALUES(:pseudo,:password,:fb_id, NOW(), :img_url) ");
                $req->execute(array(
                   'pseudo' => $pseudo,
                    'password' => $password,
                    'fb_id' => $user,
                    'img_url' => $img_url
                ));

                $query2 = $pdo->prepare("SELECT id FROM users WHERE facebook_id = :fb_id");
                $query2->execute(array(
                    'fb_id' => $user
                ));

                $data2 = $query2->fetch(PDO::FETCH_ASSOC);
                $id = $data2["id"];
                $fb_id = $pdo->lastInsertId();
            }
            else{

                $pseudo = $data['pseudo'];
                $password =$data['password'];
                $fb_id = $data['facebook_id'];
                $img_url = $fb['pic_big'];
                $id = $data['id'];
            }

            $USER = new User($id, $pseudo,null, $password,$fb_id, $img_url);
            header("location: index.php");
            return $USER;
        }
    }

}
