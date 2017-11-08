<?php

require_once __DIR__.'/../inc/config.php';

// Si non connecté
if (empty($_SESSION['userId'])) {
	header('Location: signin.php');
	exit;
}
else if ($_SESSION['userRole'] != 'admin') {
	header('Location: 403.php');
	exit;
}