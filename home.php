<?php

    session_start();
    require_once("/classes/managers/PDOUserManager.php");

    if(isset($_REQUEST["pseudo"]) && isset($_REQUEST["email"]) && isset($_REQUEST["password"]) && isset($_REQUEST["confirmation"])){
        $pseudo = $_REQUEST["pseudo"];
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        $confirmation = $_REQUEST["confirmation"];

        $userManager = new PDOUserManager();
        $userManager->registration($pseudo,$email,$password,$confirmation);

        $message = $userManager->getMessage();

    }

?>



<!DOCTYPE HTML>

    <head>
        <meta charset="utf-8" />
        <link href="../assets/css/bootstrap.css" rel="stylesheet">
         <link href="bootstrap/css/velib.css" rel="stylesheet" type="text/css">
         <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
       <title>Veliberty : Trouvez vos stations, vos vélibs et votre chemin dans Paris!</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    </head>


    <body>

        <?php include "header.php"; ?>

        <div class="container">


            <div class="row">

                <div id="logo" class="span8">
                    <img src="bootstrap/img/logo.png">
                </div>

                <div  class="span4 align-top">
                    <div class="home-message">
                        <p>Vous devez vous créer un compte pour accèder au service.</p>
                    </div>
                    <form class="form-inline" method="post">
                        <div class="control-group">
                            <div class="controls">
                                <input type="text" id="inputInfo" name="pseudo" placeholder="Pseudo"  required/>
                                <span class="help-inline"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <input type="email" autofocus required id="inputWarning" name="email" placeholder="Adresse email" />
                                <span class="help-inline"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <input type="password" id="" name="password" placeholder="Mot de passe" required/>
                                <span class="help-inline"></span>
                            </div>
                        </div>

                        <div class="control-group ">
                            <div class="control-group">
                                <div class="controls">
                                    <input type="password" id="inputError" name="confirmation" placeholder="Confirmation" required/>
                                    <span class="help-inline"></span>
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn btn-info">Inscription</button>
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
            </div>

        </div>

        <?php include "footer.php"; ?>

    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>



    </body>



