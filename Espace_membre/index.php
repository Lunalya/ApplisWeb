<?php
session_start();

require("CRUD/db.php");

	if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])){

		// VARIABLE

		$pseudo       = htmlspecialchars($_POST['pseudo']);
		$email        = htmlspecialchars($_POST['email']);
		$password     = htmlspecialchars($_POST['password']);
		$pass_confirm = htmlspecialchars($_POST['password_confirm']);

		// TEST SI PASSWORD = PASSWORD CONFIRM

		if($password != $pass_confirm){
				header('Location: index.php?error=1&pass=1');
					exit();

		}

		// TEST SI EMAIL UTILISE
		$req = $bdd->prepare("SELECT count(*) as numberEmail FROM users WHERE email = ?");
		$req->execute(array($email));

		while($email_verification = $req->fetch()){
			if($email_verification['numberEmail'] != 0) {
				header('location: index.php?error=1&email=1');
				exit();
 			}
		}

		// HASH
 		$secret = sha1($email).time();
		$secret = sha1($secret).time().time();

		// CRYPTAGE DU PASSWORD
 		$password = "aq1".sha1($password."1254")."25";

		// ENVOI DE LA REQUETE
 		$req = $bdd->prepare("INSERT INTO users(pseudo, email, password, secret) VALUES(?,?,?,?)");
		$value = $req->execute(array($pseudo, $email, $password, $secret));

		header('location: index.php?success=1');
		exit();

 	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP et MySQL</title>
	<link rel="icon" type="image/png" href="/logo.png">
	<link rel="stylesheet" type="text/css" href="design/style.css">
</head>

<body>
<div class="container">
	<header>
		<h1>Inscription</h1>
	</header>



		<?php
		if(!isset($_SESSION['connect'])){ ?>

		<p id="info">Bienvenue sur mon site, veuillez vous inscrire. Si vous possedez déjà un compte, <a href="connection.php">connectez-vous.</a></p>

		<?php

			if(isset($_GET['error'])){

				if(isset($_GET['pass'])){
					echo '<p id="error">Les mots de passe ne correspondent pas.</p>';
				}
				else if(isset($_GET['email'])){
					echo '<p id="error">Cette adresse email est déjà utilisée.</p>';
				}
			}
			else if(isset($_GET['success'])){
				echo '<p id="success">Inscription prise correctement en compte.</p>';
			}

		?>

	 	<div id="form">
			<form method="POST" action="index.php">
				<table>
					<tr>
						<td>Pseudo</td>
						<td><input type="text" name="pseudo" placeholder="Ex : Nicolas" required></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="email" name="email" placeholder="Ex : example@google.com" required></td>
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td><input type="password" name="password" placeholder="Ex : ********" required ></td>
					</tr>
					<tr>
						<td>Retaper mot de passe</td>
						<td><input type="password" name="password_confirm" placeholder="Ex : ********" required></td>
					</tr>
				</table>

				<div class="Mybtn">
					<button class="btnspan" type='submit'>Inscription</button>
				</div>
			</form>

		</div>

		<?php } else { ?>

		<p id="info">
			Bonjour <?= $_SESSION['pseudo'] ?><br>
            <a href="CRUD/index.php" class="btn btn-primary">Gérer les utilisateurs</a>
			</br>
            <p><a href="reset-password.php">Changer mot de passe</a></p>
            </br>
			<a href="disconnection.php">Déconnexion</a>
		</p>

		<?php } ?>

	</div>
</body>
</html>
