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