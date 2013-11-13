<h1><?php echo $camp['Camp']['name']; ?></h1>
<p><?php echo $camp['Camp']['description']; ?></p>
<table>
<tr>
	<th>Site</th><th>Description</th>
</tr>
<?php foreach ($camp['Site'] as $site): ?>
<tr>
	<td><?php echo $site['name'] ?></td>
	<td><?php echo $site['description'] ?></td>
	<td><?php echo $this->Form->postLink('Delete this site',
		array('controller' => 'sites', 'action' => 'delete', $site['id']),
			array('confirm' => "This will delete the site's roster and events. This cannot be undone. Do you want to proceed?")
	) ?></td>
</tr>
<?php endforeach; ?>
</table>
<p><small>Created: <?php echo $camp['Camp']['created']; ?></small></p>
<?php echo $this->Form->postLink('Add a site',
	array('action' => 'addSite', $camp['Camp']['id']));
echo $this->Form->postLink('Delete this camp', array('action' => 'delete', $camp['Camp']['id']), array('confirm' => 'This will delete the camp roster and all associated sites and events. This action cannot be undone. Do you want to proceed?')); ?>
