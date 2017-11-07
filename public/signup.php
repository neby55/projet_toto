<?php

require_once __DIR__.'/../inc/config.php';

// Gestion de l'affichage des erreurs
$errorList = array();
$successList = array();
$email = '';

// Formulaire soumis
if (!empty($_POST)) {
	print_pre($_POST);

	// Récupération des données
	$email = isset($_POST['emailToto']) ? trim($_POST['emailToto']) : '';
	$password = isset($_POST['passwordToto']) ? $_POST['passwordToto'] : '';
	$password2 = isset($_POST['passwordToto2']) ? $_POST['passwordToto2'] : '';

	// Validation des données
	if (empty($email)) {
		$errorList['email'] = 'Email vide';
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errorList['email'] = 'Email non valide';
	}

	if (empty($password) || empty($password2)) {
		$errorList['password'] = 'Mot de passe vide';
	}
	else if (strlen($password) < 8) {
		$errorList['password'] = 'Le mot de passe doit contenir au moins 8 caractères';
	}
	else if ($password != $password2) {
		$errorList['password'] = 'Les 2 mots de passe sont différents';
	}

	// Si aucune erreur
	if (empty($errorList)) {
		// J'appelle la fonction que j'ai créé qui renvoie true/false si email existe ou non
		if (emailExists($email)) {
			$errorList['email'] = 'Email déjà dans la DB';
		}
		// Sinon, j'insère le user
		else {
			// Je créé la version hashée du mot de passe
			$passwordHashed = password_hash($password, PASSWORD_BCRYPT);

			// Je prépare ma requête d'insertion
			$sql = '
				INSERT INTO `user` (usr_email, usr_password, usr_date_creation)
				VALUES (:email, :password, NOW())
			';
			$pdoStatement = $pdo->prepare($sql);
			$pdoStatement->bindValue(':email', $email);
			$pdoStatement->bindValue(':password', $passwordHashed);

			// Si erreur à l'exécution
			if ($pdoStatement->execute() === false) {
				print_r($pdoStatement->errorInfo());
				exit;
			}

			$successList[] = 'Inscription réussie !!<br>';
		}
	}
}

// A la fin, j'affiche
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/signup.php';
require_once __DIR__.'/../view/footer.php';