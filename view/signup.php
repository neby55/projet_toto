<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">Signup</div>
			<div class="panel-body">
				<?php if (!empty($successList)) : ?>
				<div class="alert alert-success">
					<?= join('<br>', $successList); ?>
				</div>
				<?php endif; ?>
				<form action="" method="post">
					<input type="hidden" name="submitSignup" value="1">
					<div class="form-group<?php if (!empty($errorList['email'])): ?> has-error<?php endif; ?>">
						<label for="email">Email</label>
						<input type="email" name="emailToto" value="<?= $email ?>" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Votre adresse email">
						<?php if (!empty($errorList['email'])): ?>
						<div class="alert alert-danger"><?= $errorList['email'] ?></div>
						<?php endif; ?>
						<small id="emailHelp" class="form-text text-muted">Nous n'allons jamais partager votre adresse email avec qui que ce soit.</small>
					</div>
					<div class="form-group<?php if (!empty($errorList['password'])): ?> has-error<?php endif; ?>">
						<label for="password">Mot de passe</label>
						<input type="password" name="passwordToto" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Votre mot de passe">
						<?php if (!empty($errorList['password'])): ?>
						<div class="alert alert-danger"><?= $errorList['password'] ?></div>
						<?php endif; ?>
						<small id="passwordHelp" class="form-text text-muted">8 caractères minimum</small>
					</div>
					<div class="form-group<?php if (!empty($errorList['password'])): ?> has-error<?php endif; ?>">
						<label for="password">Confirmation</label>
						<input type="password" name="passwordToto2" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Confirmation du mot de passe">
					</div>
					<input type="submit" class="btn btn-block btn-success" value="Je m'inscris">
				</form>
			</div>
		</div>
	</div>
</div>