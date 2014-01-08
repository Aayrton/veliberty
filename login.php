<?php

require_once(__DIR__."/classes/managers/PDOUserManager.php");

    session_start();
    if(isset($_REQUEST["email"]) && isset($_REQUEST["password"])){

        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];

        $userManager = new PDOUserManager();
        $user = $userManager->authentication($email,$password);

        $_SESSION["user"] = $user;

        $message = $userManager->getMessage();



    }
?>

<!DOCTYPE HTML>

    <head>
        <meta charset="utf-8" />
        <link href="../assets/css/bootstrap.css" rel="stylesheet">
        <link href="bootstrap/css/velib.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <title>Veliberty : Connexion</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    </head>


    <body>

    <?php include "header.php"; ?>

    <div class="container">

        <div class="row">
            <div class="span3 align-top" >
                <form class="form-horizontal" method="post">
                    <div class="control-group">

                        <div class="controls">
                            <input type="email" autofocus required="" id="inputEmail" placeholder="Adresse email" name="email">
                        </div>
                    </div>
                    <div class="control-group">

                        <div class="controls">
                            <input type="password" id="inputPassword" placeholder="Mot de passe" name="password" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-info" >Sign in</button>
                        </div>
                    </div>
                    <div class="message">
                        <?php
                        if(isset($message)){
                            echo $message;
                        }
                        ?>
                    </div>
                </form>

            </div>

            <div id="log-img" class="span6">
                <img src="bootstrap/img/login.png">

            </div>

            <div class="span3 align-top">
                <a href="fbconnect.php"><img src="bootstrap/img/facebook-ticket.png"></a>
            </div>
        </div>



    </div>

    <?php include "footer.php"; ?>

    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    </body>