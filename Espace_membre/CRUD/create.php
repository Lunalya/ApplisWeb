<?php
session_start();

error_reporting(-1);
ini_set('display_errors', 'On');

require('db.php');

if($_POST){
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])){

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);

       // HASH
        $secret = sha1($email).time();
        $secret = sha1($secret).time().time();

        // CRYPTAGE DU PASSWORD
        $password = "aq1".sha1($password."1254")."25";

        // ENVOI DE LA REQUETE
        $req = $bdd->prepare("INSERT INTO users(pseudo, email, password, secret) VALUES(?,?,?,?)");
        $value = $req->execute(array($pseudo, $email, $password, $secret));


        $_SESSION['message'] = "L'utilisateur a bien été ajouté";
        header('location: index.php');
    }

    else {
    $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>ApplisWeb</title>
</head>

<body>
<main class="container">
    <div class="row">
        <section class="col-8">
            <h1>Ajouter un utilisateur</h1>
            <?php
            if(!empty($_SESSION['erreur'])){
                ?>
                <div class="alert alert-danger" role="alert"> <?= $_SESSION['erreur'] ?></div>
                <?= $_SESSION['erreur'] = "" ?>
                <?php
            }
            ?>
            <form method="post">
                <div class="form-group">
                    <label for="pseudo">Pseudo : </label>
                    <input type="text" id="pseudo" name="pseudo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email : </label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe : </label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <button class="btn btn-primary">Envoyer</button>
            </form>
        </section>
    </div>
</main>
</body>
</html>
