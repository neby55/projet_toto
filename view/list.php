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
			<th>&nbsp;</th>
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
			<td>
				<a href="student.php?id=<?= $currentStudent['stu_id'] ?>" class="btn btn-success btnStudentDetails" data-id="<?= $currentStudent['stu_id'] ?>">details</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<script type="text/javascript">
$('.btnStudentDetails').on('click', function(e) {
	e.preventDefault();
	console.log('Click');
	var studentId = $(this).data('id'); // => attr data-id
	console.log(studentId);

	// faire l'appel Ajax
	$.ajax({
			url : 'ajax/student.php',
			method : 'post',
			dataType : 'text',
			data : {
				id : studentId
			}
		}).done(function(response) {
			console.log(response);
			// puis remplir la div (#popupStudent)
			$('#popupStudent').html(response);
			// puis afficher la div
			$('#popupStudent').show();
		});
})
</script>

<div id="popupStudent" style="display:none;position:absolute;z-index:1000;left:50%;top:10%;margin-left:-200px;width:400px;border:1px solid black;padding:10px;background: white;">
	qsdljghsfmk<br>
	qsdljghsfmk<br>
	qsdljghsfmk<br>
	qsdljghsfmk<br>
</div>