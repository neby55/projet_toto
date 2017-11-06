<?php

// J'inclus la config
require_once __DIR__.'/../inc/config.php';

// Formulaire soumis
if (!empty($_POST)) {
	// Debug
	print_pre($_POST);
	print_pre($_FILES);

	// Si upload
	if (isset($_POST['csvUpload'])) {
		// Si fichiers soumis
		if (!empty($_FILES)) {
			$csvFile = isset($_FILES['csv']) ? $_FILES['csv'] : array();

			if (!empty($csvFile)) {
				// Validations
				$formOk = true;
				if (!in_array($csvFile['type'], array('application/octet-stream', 'text/csv'))) {
					echo 'Fichier incorrect<br>';
					$formOk = false;
				}
				$dotPosition = strrpos($csvFile['name'], '.'); // Récupère la position du dernier . dans la string
				$extension = substr($csvFile['name'], $dotPosition+1);
				if (!in_array($extension, array('csv'))) {
					echo 'Extension incorrecte<br>';
				}

				if ($formOk) {
					$newFileName = md5(uniqid().'@toto-project.dev##').'.'.$extension;
					if (move_uploaded_file($csvFile['tmp_name'], __DIR__.'/../csv/'.$newFileName)) {
						echo 'upload ok<br>';

						// Ouvrir un fichier en lecture
						$fp = fopen(__DIR__.'/../csv/'.$newFileName, 'r');
						if ($fp) {
							// Préparation des insertions
							$sql = '
								INSERT INTO student (stu_lastname, stu_firstname, stu_email, stu_friendliness, stu_birthdate, city_cit_id, session_ses_id)
								VALUES (:lastname, :firstname, :email, :friendliness, :birthdate, :cityId, :sessionId)
							';
							$pdoStatement = $pdo->prepare($sql);

							// Tant que je ne suis pas à la fin du fichier
							while (!feof($fp)) {
								// Je récupère la ligne courante (puis passe à la suivante)
								$line = trim(fgets($fp));

								// Je ne prends en compte que les lignes non vides (la dernière est souvent vide)
								if (!empty($line)) {
									// Je récupère les données de la ligne sous forme de tableau (je coupe la chaine à chaque ;)
									$studentInfos = explode(';', $line);

									// Debug
									print_pre($studentInfos);

									// Insertion
									$pdoStatement->bindValue(':lastname', $studentInfos[0]);
									$pdoStatement->bindValue(':firstname', $studentInfos[1]);
									$pdoStatement->bindValue(':email', $studentInfos[2]);
									$pdoStatement->bindValue(':friendliness', $studentInfos[3], PDO::PARAM_INT);
									$pdoStatement->bindValue(':birthdate', $studentInfos[4]);
									$pdoStatement->bindValue(':cityId', 4, PDO::PARAM_INT);
									$pdoStatement->bindValue(':sessionId', 1, PDO::PARAM_INT);
									// Exécution de l'insertion
									$pdoStatement->execute();
								}
							}
							fclose($fp);
						}
					}
					else {
						echo 'error in upload<br>';
					}
				}
			}
		}
	}
	// Si Export
	else if (isset($_POST['csvGeneration'])) {
		$sql = '
			SELECT stu_lastname, stu_firstname, stu_email, stu_friendliness, stu_birthdate
			FROM student
		';
		$pdoStatement = $pdo->query($sql);

		if ($pdoStatement && $pdoStatement->rowCount() > 0) {
			// TODO écrire dans le fichier
			while (($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) !== false) {
				print_pre($row);
			}
		}
	}
}

// A la fin, j'affiche
require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/csv.php';
require_once __DIR__.'/../view/footer.php';