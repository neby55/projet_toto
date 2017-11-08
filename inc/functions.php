<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Don't forget "composer require" in the projet toto

function getSympathieLabel($friendliness) {
	$sympathieList = getSympathieList();

	if (array_key_exists($friendliness, $sympathieList)) {
		return $sympathieList[$friendliness];
	}
}

function getSympathieList() {
	return array(
		1 => 'Pas sympa',
		2 => 'Assez sympa',
		3 => 'Sympa',
		4 => 'Très sympa',
		5 => 'Génial',
	);
}

function print_pre($var) {
	echo '<pre>'.print_r($var,1).'</pre>';
}

function emailExists($emailAddress) {
	global $pdo; // Je globalise/importe car $pdo est créé en dehors de la fonction

	// Je vérifie que l'email n'existe pas
	$sql = '
		SELECT *
		FROM `user`
		WHERE usr_email = :email
	';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':email', $emailAddress);
	if ($stmt->execute() === false) {
		print_r($stmt->errorInfo());
		exit;
	}

	// Si il existe un email => au moins 1 ligne de résultat
	return ($stmt->rowCount() > 0);
}

function getUserByEmail($emailAddress) {
	global $pdo; // Je globalise/importe car $pdo est créé en dehors de la fonction

	// Je vérifie que l'email n'existe pas
	$sql = '
		SELECT *
		FROM `user`
		WHERE usr_email = :email
	';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':email', $emailAddress);
	if ($stmt->execute() === false) {
		print_r($stmt->errorInfo());
		exit;
	}

	// Si il existe un email => au moins 1 ligne de résultat
	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function sendEmail($to, $subject, $htmlContent, $textContent='') {
	global $config;
    // TODO move the phpmailer code here, and replace some strings with parameters

	// Avec la config
	$mail->Host = $config['MAIL_HOST'];
    $mail->Username = $config['MAIL_USERNAME'];
    $mail->Password = $config['MAIL_PASSWORD'];
}