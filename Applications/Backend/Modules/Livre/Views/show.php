<div class="page-header">	<h1>Livre</h1></div><?php if ($user->hasFlashError()) { ?>	<div class="alert alert-warning">		<?php echo $user->getFlashError(); ?>	</div><?php } ?><?php if ($user->hasFlash()) { ?>	<div class="alert alert-success">		<?php echo $user->getFlash(); ?>	</div><?php } ?>	<form action="" method="post" class="form-horizontal well">	<fieldset>		<legend><?php echo $livre->nom(); ?></legend>				<?php if($livre->couverture() != '') { ?>			<div class="form-photo col-lg-4">				<img src="<?php echo $livre->couverture(); ?>" alt="couverture" />			</div>		<?php } ?>				<div <?php if($livre->couverture() != '') { ?> class="col-lg-8" <?php } ?>>					<div class="form-group">				<label class="col-lg-3 control-label">Année : </label>				<p class="col-lg-4 form-control-static"><?php echo $livre->annee(); ?></p>			</div>						<div class="form-group">				<label class="col-lg-3 control-label">Genre : </label>				<p class="col-lg-4 form-control-static"><?php echo $livre->genreLibelle(); ?></p>			</div>						<div class="form-group">				<label class="col-lg-3 control-label">Auteur : </label>				<p class="col-lg-4 form-control-static"><?php echo $livre->auteurNom().' '.$livre->auteurPrenom(); ?></p>			</div>						<div class="form-group">				<div class="col-lg-3"></div>				<div class="col-lg-4 checkbox">					<label>						<input type="checkbox" disabled="disabled" <?php if($livre->poche()) {echo 'checked';} ?>/>											Poche					</label>				</div>			</div>						<?php if($want == true && count($utilisateurs) > 0) { ?>				<div class="form-group">					<p class="col-lg-12 form-control-static hr"></p>				</div>							<div class="form-group">					<label class="col-lg-3 control-label">Ils possèdent ce livre : </label>					<ul class="col-lg-4 form-control-static">						<?php foreach($utilisateurs as $utilisateur) { ?>							<li><a href="mailto:<?php echo $utilisateur->email(); ?>"><?php echo $utilisateur->login(); ?></a></li>						<?php } ?>					</ul>				</div>			<?php } ?>		</div>				<div class="text-align-right clear-both">			<a href="/livre-get-<?php echo $get == true ? 'remove-' : ''; ?><?php echo $livre->id(); ?>.html" class="btn <?php echo $get == false ? 'btn-danger' : 'btn-success'; ?>"><span class="glyphicon glyphicon-<?php echo $get == false ? 'remove' : 'ok'; ?>"></span>&nbsp;Je possède ce livre !</a>			<a href="/livre-read-<?php echo $read == true ? 'remove-' : ''; ?><?php echo $livre->id(); ?>.html" class="btn <?php echo $read == false ? 'btn-danger' : 'btn-success'; ?>"><span class="glyphicon glyphicon-<?php echo $read == false ? 'remove' : 'ok'; ?>"></span>&nbsp;J'ai lu ce livre !</a>			<a href="/livre-want-<?php echo $want == true ? 'remove-' : ''; ?><?php echo $livre->id(); ?>.html" class="btn <?php echo $want == false ? 'btn-danger' : 'btn-success'; ?>"><span class="glyphicon glyphicon-<?php echo $want == false ? 'remove' : 'ok'; ?>"></span>&nbsp;Je veux ce livre !</a>		</div>				<div class="text-align-right clear-both margin-top-5">			<a href="/livre-edit-<?php echo $livre->id(); ?>.html" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier</a>			<a id="confirmModalLink" href="/livre-delete-<?php echo $livre->id(); ?>.html" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Supprimer</a>		</div>	</fieldset></form><div class="text-align-right">	<a href="/livres-<?php echo strtolower(substr($livre->nom(), 0, 1)); ?>.html">Retour à la liste des livres</a></div><div class="text-align-right">	<a href="/livre-new.html">		Ajouter un autre livre	</a></div><div class="modal fade" id="confirmModal">	<div class="modal-dialog">		<div class="modal-content">			<div class="modal-header">				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>				<h4>Confirmation de la suppression</h4>			</div>			<div class="modal-body">				<p>Etes-vous sûr de vouloir supprimer ce livre ?</p>			</div>			<div class="modal-footer">				<a href="#" class="btn btn-default" id="confirmModalNo">Non</a>				<a href="#" class="btn btn-primary" id="confirmModalYes">Oui</a>			</div>		</div>	</div></div><script type="text/javascript">	$(document).ready(function () {				var theHREF;				$("#confirmModalLink").click(function(e) {			e.preventDefault();			theHREF = $(this).attr("href");			$("#confirmModal").modal("show");		});				$("#confirmModalNo").click(function(e) {			$("#confirmModal").modal("hide");		});				$("#confirmModalYes").click(function(e) {			window.location.href = theHREF;		});			});</script>