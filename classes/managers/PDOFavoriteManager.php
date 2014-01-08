<?php

require_once("PDOManager.php");

class PDOFavoriteManager {

    public function addFavorite($name,$user_id,$address){
        $PDOManager = new \PDOManager();
        $pdo = $PDOManager->newPdo();

        $query = $pdo->prepare("INSERT INTO favorites(name,user_id,address) values(:name,:user_id,:address) ");
        $query->execute(array(
            "name"=>$name,
            "user_id"=>$user_id,
            ":address"=>$address
        ));

    }

    public function showFavorite($user_id){
        $PDOManager = new PDOManager;
        $pdo = $PDOManager->newPdo();

        $query = $pdo->prepare("SELECT * FROM favorites WHERE user_id = :userId");
        $query->execute(array(
            'userId' => $user_id
        ));

        $data = $query->fetchAll();


        echo '<table class="table table-hover"> <thead><tr><th>Nom</th><th>Adresse</th></tr></thead>';

        foreach($data as $row){

            echo '<tr class="favorite">' . '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["address"] . '</td>';
            echo '<td> <a class="close" href=deleteFavorite.php?id=' . $row["id"] . '> &times;' . '</td> </a> </tr>';
        }

        echo '</table>';



    }

    public function delete($urlId){
        $PDOManager = new PDOManager;
        $pdo = $PDOManager->newPdo();

        $query = $pdo->prepare('DELETE FROM favorites WHERE id = :id');
        $query->execute(array(
            'id' => $urlId
        ));
    }

}