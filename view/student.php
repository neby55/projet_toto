<a href="javascript:$('#popupStudent').hide();">Fermer</a>
<div class="panel panel-primary">
	<div class="panel-heading">#<?= $studentId ?> <?= $studentInfos['stu_lastname'] ?> <?= $studentInfos['stu_firstname'] ?></div>
	<div class="panel-body">
		<ul>
			<li>Nom : <?= $studentInfos['stu_lastname'] ?></li>
			<li>Prénom : <?= $studentInfos['stu_firstname'] ?></li>
			<li>Email : <?= $studentInfos['stu_email'] ?></li>
			<li>Date de naissance : <?= $studentInfos['stu_birthdate'] ?></li>
			<li>Âge : <?= $studentInfos['age'] ?></li>
			<li>Ville : <?= $studentInfos['cit_name'] ?></li>
			<li>Sympathie : <?= getSympathieLabel($studentInfos['stu_friendliness']) ?></li>
			<li>Numéro de session : <?= $studentInfos['ses_number'] ?></li>
			<li>Nom de session : <?= $studentInfos['loc_name'] ?></li>
		</ul>
	</div>
</div>