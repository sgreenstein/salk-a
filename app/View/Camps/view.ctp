<head>
	<?php echo $this->Html->script('libs/system-search'); ?>
</head>

<h1>
	<?php echo $camp['Camp']['name']; ?>
</h1>

<p>
	<?php echo $camp['Camp']['description']; ?>
</p>

<div>
	<form action="#" method="get">
		<div class="input-group">
			<input class="form-control" id="system-search" name="q" placeholder="Search for" required>
			<span class="input-group-btn">
				<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
			</span>
		</div>
	</form>
	<table class="table table-hover table-list-search">
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
	<a href="/camps/addSite/<?php echo $camp['Camp']['id']; ?>/" class="btn btn-primary">Add Site</a>
</div>