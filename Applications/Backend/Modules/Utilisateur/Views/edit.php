<h1>Mon compte</h1><?php if ($user->hasFlashError()) { ?>	<div class="alert alert-error">		<?php echo $user->getFlashError(); ?>	</div><?php } ?><?php if ($user->hasFlash()) { ?>	<div class="alert alert-success">		<?php echo $user->getFlash(); ?>	</div><?php } ?><form action="" method="post" class="form-horizontal well">	<fieldset>		<legend>Modifier mon compte</legend>				<?php echo $form; ?>				<div class="text-align-right">			<button class="btn btn-success" type="submit"><i class="icon-ok icon-white"></i>&nbsp;Sauvegarder</button>		</div>	</fieldset></form>