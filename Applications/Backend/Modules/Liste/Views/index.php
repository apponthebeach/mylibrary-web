<div class="page-header">	<h1>Choisir la liste d'un utilisateur</h1></div><table class="table table-striped">	<tbody>	<?php		foreach($utilisateursList as $utilisateur) {	?>		<tr>			<td><?php echo strtoupper($utilisateur->login()); ?></td>			<td><a href="/livres-read-<?php echo $utilisateur->id(); ?>.html">A lu</a></td>			<td><a href="/livres-get-<?php echo $utilisateur->id(); ?>.html">Possède</a></td>			<td><a href="/livres-want-<?php echo $utilisateur->id(); ?>.html">Veut</a></td>		</tr>	<?php } ?>	<tbody></table>