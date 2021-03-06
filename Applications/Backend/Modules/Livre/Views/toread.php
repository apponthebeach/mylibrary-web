<div class="page-header">
	<div class="panel-gestion float-right">
		<a class="btn btn-primary" href="/livres-read-export.html" target="_blank">
			<span class="glyphicon glyphicon-download-alt"></span>
			&nbsp;Exporter au format PDF
		</a>
	</div>

	<h1><?php echo $utilisateur->login(); ?> n'a pas lu <?php echo count($livresList); ?> livre(s)</h1>
</div>

<?php if ($user->hasFlashError()) { ?>
	<div class="alert alert-warning clear-both">
		<?php echo $user->getFlashError(); ?>
	</div>
<?php } ?>

<?php if ($user->hasFlash()) { ?>
	<div class="alert alert-success clear-both">
		<?php echo $user->getFlash(); ?>
	</div>
<?php } ?>

<table class="table table-striped clear-both">
	<thead>
		<tr>
			<th>#</th>
			<th>Titre</th>
			<th>Auteur</th>
			<th>Année</th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach($livresList as $livre) {
	?>
		<tr>
			<td><?php echo $livre->id(); ?></td>
			<td><a class="text-decoration-none" href="/livre-<?php echo $livre->id(); ?>.html"><?php echo $livre->nom(); ?></a></td>
			<td><?php echo $livre->auteurNom() . ' ' . $livre->auteurPrenom(); ?></td>
			<td><?php echo $livre->annee(); ?></td>
		</tr>
	<?php } ?>
	<tbody>
</table>

<div class="panel-gestion">
	<a class="btn btn-primary" href="/livres-read-export.html" target="_blank">
		<span class="glyphicon glyphicon-download-alt"></span>
		&nbsp;Exporter au format PDF
	</a>
</div>