<?php


require_once(__DIR__."/classes/managers/PDOFavoriteManager.php");
require_once(__DIR__."/classes/managers/PDOUserManager.php");

session_start();

    if(!isset($_SESSION["user"])){
        header("location: home.php");
    }
    else{
        $name = $_GET["name"];
        $address = $_GET["address"];
        $user_id = $_SESSION["user"]->getId();

        $favoriteManager = new \PDOFavoriteManager();

        $favoriteManager->addFavorite($name,$user_id,$address);

        header("location: index.php");
    }