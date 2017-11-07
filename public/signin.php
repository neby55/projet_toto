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

	// Validation des données
	if (empty($email)) {
		$errorList['email'] = 'Email vide';
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errorList['email'] = 'Email non valide';
	}

	if (empty($password)) {
		$errorList['password'] = 'Mot de passe vide';
	}
	else if (strlen($password) < 8) {
		$errorList['password'] = 'Le mot de passe doit contenir au moins 8 caractères';
	}

	// Si aucune erreur
	if (empty($errorList)) {
		// J'appelle la fonction que j'ai créé qui renvoie true/false si email existe ou non
		if (emailExists($email)) {
			// J'appelle ma fonction qui renvoie les données sur un user pour un email fourni
			$userInfos = getUserByEmail($email);

			// Je vérifie le mot de passe avec password_verify
			if (password_verify($password, $userInfos['usr_password'])) {
				$successList[] = 'User connecté !!!!';
				$successList[] = 'UserID = '.$userInfos['usr_id'];
				$successList[] = 'IP = '.$_SERVER['REMOTE_ADDR'];
			}
			else {
				$errorList['password'] = 'Password erroné';
			}
		}
		// Sinon, j'affiche l'erreur email non reconnu
		else {
			$errorList['email'] = 'Email inexistant';
		}
	}
}

// A la fin, j'affiche
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/signin.php';
require_once __DIR__.'/../view/footer.php';