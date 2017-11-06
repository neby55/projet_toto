<div class="row">
	<div class="col-md-6">
		<h3>Upload d'un fichier CSV</h3>
		<!-- Si envoi de ficher => POST + enctype !!! -->
		<form action="" method="post" enctype="multipart/form-data">
			<fieldset>
			<input type="hidden" name="csvUpload" value="1" />
			<label for="csv">Fichier</label>
			<input type="file" name="csv" id="csv" />
			<p class="help-block">Fichier CSV, avec les champs séparés par <strong>;</strong> => Nom;Prénom;Email;Sympathie;Date de naissance</p>
			<br />
			<input type="submit" class="btn btn-success btn-block" value="Téléverser" />
			</fieldset>
		</form>
	</div>
	<div class="col-md-6">
		<h3>Export en CSV</h3>
		<!-- Si envoi de ficher => POST + enctype !!! -->
		<form action="" method="post" enctype="multipart/form-data">
			<fieldset>
			<input type="hidden" name="csvGeneration" value="1" />
			<input type="submit" class="btn btn-success btn-block" value="Export CSV" />
			</fieldset>
		</form>
	</div>
</div>