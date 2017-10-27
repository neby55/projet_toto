Je suis sur la page <strong>LISTE</strong>.

<!-- TODO afficher tous les étudiants (récupérés dans public/list.php) dans <table></table> -->

<table class="table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Email</th>
			<th>Date de naissance</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($studentList as $currentStudent) : ?>
		<tr>
			<td><?= $currentStudent['stu_id'] ?></td>
			<td><?= $currentStudent['stu_lastname'] ?></td>
			<td><?= $currentStudent['stu_firstname'] ?></td>
			<td><?= $currentStudent['stu_email'] ?></td>
			<td><?= $currentStudent['stu_birthdate'] ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>