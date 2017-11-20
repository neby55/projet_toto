<?php

require_once __DIR__.'/../../inc/config.php';

// Récupération de l'id passé dans l'URL
$studentId = isset($_POST['id']) ? intval($_POST['id']) : 0;

$studentInfos = array();
$sql = '
	SELECT stu_id, stu_lastname, stu_firstname, stu_email, stu_birthdate, cit_name, stu_friendliness, ses_number, loc_name
	FROM student
	INNER JOIN city ON city.cit_id = student.city_cit_id
	INNER JOIN session ON session.ses_id = student.session_ses_id
	INNER JOIN location ON location.loc_id = session.location_loc_id
	WHERE stu_id = :id
';
$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':id', $studentId, PDO::PARAM_INT);

if ($pdoStatement->execute() === false) {
	print_r($pdoStatement->errorInfo());
}
else {
	// 1 seul résultat => fetch
	$studentInfos = $pdoStatement->fetch(PDO::FETCH_ASSOC);

	$studentInfos['age'] = floor((time() - strtotime($studentInfos['stu_birthdate'])) / (365.25*86400));
}

// A la fin, j'affiche
require_once __DIR__.'/../../view/student.php';