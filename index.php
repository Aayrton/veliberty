<?php

require_once("/classes/managers/PDOUserManager.php");
require_once("/classes/managers/PDOFavoriteManager.php");
    session_start();

    if(!isset($_SESSION["user"])){
        header("location: home.php");
    }
    else{
        $favoriteManager = new PDOFavoriteManager();

    }

?>

<!DOCTYPE HTML>


<head xmlns="http://www.w3.org/1999/html">
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <link href="bootstrap/css/velib.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <title>Veliberty : Parcourez la map</title>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=fr"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    </head>

    <body onload="initialize();">

    <div id="profile">

            <div  class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="text-transform: capitalize;">
                    <?php
                        echo '<img src="'.$_SESSION["user"]->getImgUrl().'" class="p_picture"/>';
                        echo $_SESSION["user"]->getPseudo();
                    ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu" >
                    <li><a  href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php">Deconnexion</a></li>
                </ul>
            </div>

    </div>

    <div class="row-fluid">
        <div class="span3" id="rightNav">

            <h3 class="top-space">Favoris</h3>
            <div id="fav-list">
                <?php
                $favoriteManager->showFavorite($_SESSION["user"]->getId());
                ?>
            </div>

            <h3>Trouvez votre chemin</h3>
            <div id="gps">
                <?php if(isset($_GET["addressBike"])){ ?>
                    <form method="get" id="direction">
                        <input type="text" class="input-xlarge" id="origin" name="origin" value="<?php echo htmlspecialchars($_GET["addressBike"]); ?>">
                        <input type="text" class="input-xlarge" id="destination" name="destination" placeholder="Point d'arrivé"> <br />
                        <input type="button" class="btn btn-info" value="Itineraire" style="float: right" onclick="javascript: calculateDirection()"> <br />
                    </form>

                <?php }
                elseif(!isset($_GET["addressBike"])){ ?>
                    <form method="get" id="direction">
                        <input type="text" class="input-xlarge" id="origin" name="origin" placeholder="Point de départ">
                        <input type="text" class="input-xlarge" id="destination" name="destination" placeholder="Point d'arrivé"> <br />
                        <input type="button" class="btn btn-info" value="Itineraire" style="float: right" onclick="javascript: calculateDirection()"> <br />
                    </form>
                <?php } ?>
            </div>

            <div id="instruction"></div>

           <!-- <div id="content">

            </div>-->
        </div>

        <div id="map"><!--<div id="backMap"></div>--></div>
        </div>




    <script src="js/infobox.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/velib2.js" type="text/javascript"></script>
    </body>