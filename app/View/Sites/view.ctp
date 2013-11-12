<h1><?php echo $site['Site']['name']; ?></h1>
<p><?php echo $site['Site']['description']; ?></p>
<p><small>Created: <?php echo $site['Site']['created']; ?></small></p>
<?php echo $this->Form->postLink('Delete this site',
	array('action' => 'delete', $site['Site']['id']),
	array('confirm' => 'This will delete the site roster and all site events. This action cannot be undone. Do you want to proceed?', ));
?>
