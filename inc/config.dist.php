<?php

session_start();

// Données de configuration
$config = array(
	'DB_HOST' => '',
	'DB_USER' => '',
	'DB_PASSWORD' => '',
	'DB_DATABASE' => '',
    'MAIL_HOST' => '',
    'MAIL_USERNAME' => '',
    'MAIL_PASSWORD' => '',
);

// Inclusions de fichiers
require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';

// Inclusion de composer (pour avoir toutes les libraires installés via composer)
require_once __DIR__.'/../vendor/autoload.php';

// Social Networks
//Create a Page instance with the url information
$socialLinksPage = new SocialLinks\Page([
    'url' => 'http://projet-toto.dev',
    'title' => 'Projet TOTO',
    'text' => 'Extended page description',
    'image' => 'http://mypage.com/image.png',
    'icon' => 'http://mypage.com/favicon.png',
    'twitterUser' => '@twitterUser'
]);
//print_r($socialLinksPage);