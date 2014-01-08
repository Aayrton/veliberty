<?php


require_once(__DIR__."/classes/managers/PDOUserManager.php");
require_once(__DIR__."/classes/managers/PDOFavoriteManager.php");

session_start();
if(isset($_GET["id"])&&isset($_SESSION["user"])){
    $userId = $_GET["id"];
    $favoriteManager = new PDOFavoriteManager();

    $favoriteManager->delete($userId);
    header("location: index.php");
}
else{
    header("location: index.php");
}