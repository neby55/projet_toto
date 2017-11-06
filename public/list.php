<?php

require_once __DIR__.'/../inc/config.php';

$studentList = array();
// Page sasie dans l'URL
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

/*
page => offset
1 => 0
2 => 3
3 => 6
4 => 9
5 => 12
*/
// Je calcule automatiquement l'offset
$offset = ($page-1) * 3;
// Je corrige une possible erreur de calcul
if ($offset < 0) {
	$offset = 0;
}

// Récupération du terme recherché
$search = isset($_GET['s']) ? trim($_GET['s']) : '';
// Si recherche, ma requête effectue une recherche et ne fait pas de pagination
if (!empty($search)) {
	$sql = '
		SELECT *
		FROM student
		WHERE stu_lastname LKE :search
		OR stu_firstname LIKE :search
		OR stu_email LIKE :search
	';
	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindValue(':search', '%'.$search.'%');
	$pdoStatement->execute();
}
// Sinon, on prend tous les étudiants, et on fait la pagination
else {
	$sql = '
		SELECT *
		FROM student
		LIMIT 3 OFFSET '.$offset;
	$pdoStatement = $pdo->query($sql);
}

if ($pdoStatement === false) {
	print_r($pdo->errorInfo());
}
else {
	$studentList = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
}

// A la fin, j'affiche
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/list.php';
require_once __DIR__.'/../view/footer.php';