<div class="page-header">	<h1>Resultats de la recherche (<?php echo count($livresList); ?>)</h1></div><?php if ($user->hasFlashError()) { ?>	<div class="alert alert-warning">		<?php echo $user->getFlashError(); ?>	</div><?php } ?><?php if ($user->hasFlash()) { ?>	<div class="alert alert-success">		<?php echo $user->getFlash(); ?>	</div><?php } ?><table class="table table-striped">	<thead>		<tr>			<th>#</th>			<th>Titre</th>			<th>Auteur</th>			<th>Année</th>			<th></th>		</tr>	</thead>	<tbody>	<?php		foreach($livresList as $livre) {	?>		<tr>			<td><?php echo $livre->id(); ?></td>			<td><a href="/livre-<?php echo $livre->id(); ?>.html"><?php echo $livre->nom(); ?></a></td>			<td><?php echo $livre->auteurNom() . ' ' . $livre->auteurPrenom(); ?></td>			<td><?php echo $livre->annee(); ?></td>			<td>				<a class="confirmModalLink" class="text-decoration-none" href="/suggestion-delete-<?php echo $livre->id(); ?>.html">					<img src="/images/icons/remove.png" alt="supprimer" />				</a>			</td>		</tr>	<?php } ?>	<tbody></table><div class="modal fade" id="confirmModal">	<div class="modal-dialog">		<div class="modal-content">			<div class="modal-header">				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>				<h4>Confirmation de la suppression</h4>			</div>			<div class="modal-body">				<p>Etes-vous sûr de vouloir supprimer ce livre de la liste des suggestions ?</p>			</div>			<div class="modal-footer">				<a href="#" class="btn btn-default" id="confirmModalNo">Non</a>				<a href="#" class="btn btn-primary" id="confirmModalYes">Oui</a>			</div>		</div>	</div></div><script type="text/javascript">	$(document).ready(function () {				var theHREF;				$(".confirmModalLink").click(function(e) {			e.preventDefault();			theHREF = $(this).attr("href");			$("#confirmModal").modal("show");		});				$("#confirmModalNo").click(function(e) {			$("#confirmModal").modal("hide");		});				$("#confirmModalYes").click(function(e) {			window.location.href = theHREF;		});			});</script>