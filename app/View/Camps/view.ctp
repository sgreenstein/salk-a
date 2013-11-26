<h1> <?php echo $camp['Camp']['name']; ?> </h1>

<p> <?php echo $camp['Camp']['description']; ?> </p>

<table class="table table-hover">
	<tr>
		<th>Site</th>
		<th>Description</th>
	</tr>
	<?php foreach ($camp['Site'] as $site): ?>
	<tr>
		<td>
			<?php echo $site['name'] ?>
		</td>
		<td>
			<?php echo $site['description'] ?>
		</td>
		<td>
			<?php echo $this->Form->postLink('Delete this site', array('controller' => 'sites', 'action' => 'delete', $site['id']), array('confirm' => "This will delete the site's roster and events. This cannot be undone. Do you want to proceed?"))?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php echo $this->Form->postButton('Add a site', array('action' => 'addSite', $camp['Camp']['id']), array('type' => 'button', 'class' => 'btn btn-primary')); ?>