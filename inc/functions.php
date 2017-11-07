<?php

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