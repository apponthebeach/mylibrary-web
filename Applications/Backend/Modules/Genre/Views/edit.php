<div class="page-header">	<h1>Genre</h1></div><?php if ($user->hasFlashError()) { ?>	<div class="alert alert-warning">		<?php echo $user->getFlashError(); ?>	</div><?php } ?><?php if ($user->hasFlash()) { ?>	<div class="alert alert-success">		<?php echo $user->getFlash(); ?>	</div><?php } ?><form action="" method="post" class="form-horizontal well" enctype="multipart/form-data">	<fieldset>		<legend>Modifier un genre</legend>				<?php echo $form; ?>				<div class="text-align-right">			<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;Sauvegarder</button>			<a href="/genres.html" class="btn btn-primary">&nbsp;Annuler</a>		</div>	</fieldset></form>