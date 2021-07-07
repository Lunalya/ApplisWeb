<?php
session_start();

error_reporting(-1);
ini_set('display_errors', 'On');

require('db.php');


if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = htmlspecialchars($_GET['id']);

    $req = $bdd->prepare('SELECT * FROM users WHERE id = :id');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $result = $req->fetch();

    if(!$result){
        $_SESSION['erreur'] = "Cet ID n'existe pas";
        header('location: index.php');
    }

    $req = $bdd->prepare('DELETE FROM users WHERE id = :id');
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();

    $_SESSION['message'] = "L'utilisateur a bien été supprimé";
    header('location: index.php');

}
else {
    $_SESSION['erreur'] = "L'URL demandé n'existe pas";
    header('location: index.php');
}

?>