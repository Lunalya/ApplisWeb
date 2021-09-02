<?php
session_start();

error_reporting(-1);
ini_set('display_errors', 'On');

require('db.php');

if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['email']) && !empty($_POST['email'])){

        $id  = htmlspecialchars($_POST['id']);
        $pseudo   = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);

        $req = $bdd->prepare("UPDATE users SET id = :id, pseudo = :pseudo, email = :email WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();

        $_SESSION['message'] = "L'utilisateur a bien été modifié";
        header('location: index.php');

    }
    else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

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

}
else {
    $_SESSION['erreur'] = "L'URL demandé n'existe pas";
    header('location: index.php');
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
                <h1>Modifier un utilisateur</h1>
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
                        <label for="title">Pseudo : </label>
                        <input type="text" id="pseudo" name="pseudo" class="form-control" value=" <?= $result['pseudo'] ?>">
                    </div>
                    <div class="form-group">
                    <label for="content">Email : </label>
                        <input type="email" id="email" name="email" class="form-control" value=" <?= $result['email'] ?>">
                    </div>
                    <input type="hidden" value=" <?= $result['id'] ?>" name="id">
                    <button class="btn btn-warning">Modifier</button>
                    <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
