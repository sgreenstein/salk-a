<h1><?php echo $camp['Camp']['name']; ?></h1>
<p><?php echo $camp['Camp']['description']; ?></p>
<table>
<?php foreach ($camp['Site'] as $site): ?>
<tr>
	<td><?php echo $site['name'] ?></td>
	<td><?php echo $site['description'] ?></td>
</tr>
<?php endforeach; ?>
</table>
<p><small>Created: <?php echo $camp['Camp']['created']; ?></small></p>
<?php echo $this->Form->postButton('Add a site',
	array('action' => 'addSite', $camp['Camp']['id']));
echo $this->Form->postLink('Delete this camp', array('action' => 'delete', $camp['Camp']['id']), array('confirm' => 'This will delete the camp roster and all associated sites and events. This action cannot be undone. Do you want to proceed?', )); ?>
