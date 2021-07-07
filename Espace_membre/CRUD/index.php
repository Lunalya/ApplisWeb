<?php 
session_start();

error_reporting(-1);
ini_set('display_errors', 'On');

require('db.php');

// Ma requete SELECT 

$req = $bdd->prepare('SELECT * FROM users');
$req->execute();
$result = $req->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>ApplisWeb</title>
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Les comptes utilisateurs: </h1>
                <?php
                    if(!empty($_SESSION['erreur'])){
                ?>
                    <div class="alert alert-danger" role="alert"> <?= $_SESSION['erreur'] ?></div>
                    <?= $_SESSION['erreur'] = "" ?>
                <?php
                    }
                ?>
                <?php
                    if(!empty($_SESSION['message'])){
                ?>
                    <div class="alert alert-sucess" role="alert"> <?= $_SESSION['message'] ?></div>
                    <?= $_SESSION['message'] = "" ?>
                <?php
                    }
                ?>
                 <table class="table">
                    <thead>
                        <th>Id</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($result as $pseudo) {

                        ?>
                            <tr>
                                <td> <?= $pseudo['id'] ?> </td>
                                <td> <?= $pseudo['pseudo'] ?> </td>
                                <td> <?= $pseudo['email'] ?> </td>
                                <td>
                                    <a href="read.php?id=<?= $pseudo['id'] ?>" class="btn btn-info">Voir</a>
                                    <a href="update.php?id=<?= $pseudo['id'] ?>" class="btn btn-warning">Modifier</a>
                                    <a href="delete.php?id=<?= $pseudo['id'] ?>" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                        <?php       
                            }
                        ?>

                            </tbody>
                        </table>
                        <a href="create.php" class="btn btn-primary">Ajouter un utilisateur</a>
                        <a href="../connection.php" class="btn btn-info">Retour au formulaire</a>
                    </section>
                </div>
            </main>
        </body>
        </html>