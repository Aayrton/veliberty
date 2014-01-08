<?php

require_once(__DIR__."/classes/managers/PDOUserManager.php");
    session_start();
    $userManager = new PDOUserManager();
   $user = $userManager->fbConnect();

    $_SESSION["user"] = $user;



?>