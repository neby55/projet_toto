<?php

// J'inclus la config
require_once __DIR__.'/../inc/config.php';

// Je supprime les données en session
session_destroy();

// Je redirige sur la home
header('Location: index.php');