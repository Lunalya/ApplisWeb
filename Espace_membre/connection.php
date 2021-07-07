<?php
session_start();

if(isset($_SESSION['connect'])){
	header('location: index.php');
	exit();
}

require('CRUD/db.php');

// CONNEXION
if(!empty($_POST['email']) && !empty($_POST['password'])){

	// VARIABLES
	$email 		= $_POST['email'];
	$password 	= $_POST['password'];
	$error		= 1;

	// CRYPTER LE PASSWORD
	$password = "aq1".sha1($password."1254")."25";

	echo $password;

	$req = $bdd->prepare('SELECT * FROM users WHERE email = ?');
	$req->execute(array($email));

	while($user = $req->fetch()){

		if($password == $user['password']){
			$error = 0;
			$_SESSION['connect'] = 1;
			$_SESSION['pseudo']	 = $user['pseudo'];

			if(isset($_POST['connect'])) {
				setcookie('log', $user['secret'], time() + 365*24*3600, '/', null, false, true);
			}

			header('location: connection.php?success=1');
			exit();
		}

	}

	if($error == 1){
		header('location: connection.php?error=1');
		exit();
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="design/style.css">
</head>
<body>
<div class="container">
	<header>
		<h1>Connexion</h1>
	</header>


		<p id="info">Bienvenue sur mon site,si vous n'êtes pas inscrit, <a href="index.php">inscrivez-vous.</a></p>
	 	
		<?php
			if(isset($_GET['error'])){
				echo'<p id="error">Nous ne pouvons pas vous authentifier.</p>';
			}
			else if(isset($_GET['success'])){
				echo'<p id="success">Vous êtes maintenant connecté.</p>';
			}
		?>

	 	<div id="form">
			<form method="POST" action="connection.php">
				<table>
					<tr>
						<td>Email</td>
						<td><input type="email" name="email" placeholder="Ex : example@google.com" required></td>
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td><input type="password" name="password" placeholder="Ex : ********" required ></td>
					</tr>
				</table>
				<div id="button">
				<div class="Mybtn">
					<button class="btnspan" type='submit'>Connexion</button>
				</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>