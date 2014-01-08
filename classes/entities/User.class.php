<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ayrton
 * Date: 18/02/13
 * Time: 15:04
 * To change this template use File | Settings | File Templates.
 */
class User
{
    private $id;
    private $pseudo;
    private $email;
    private $password;
    private $facebook_id;
    private $img_url;





    function __construct($id, $pseudo, $email, $password, $facebook_id, $img_url)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->facebook_id = $facebook_id;
        $this->img_url = $img_url;
    }

    public function setImgUrl($img_url)
    {
        $this->img_url = $img_url;
    }

    public function getImgUrl()
    {
        return $this->img_url;
    }

    public function setFacebookId($facebook_id)
    {
        $this->facebook_id = $facebook_id;
    }

    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }


}
