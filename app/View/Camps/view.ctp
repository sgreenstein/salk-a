<head>
	<?php echo $this->Html->script('libs/system-search'); ?>
</head>

<div class="row">
	<div class="col-md-8">
		<h1>
			<?php echo $camp['Camp']['name']; ?>
		</h1>
		<p>
			<?php echo $camp['Camp']['description']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<form action="#" method="get">
			<div class="input-group">
				<input class="form-control" id="system-search" name="q" placeholder="Search for" required>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
				</span>
			</div>
		</form>
	</div>
</div>

<div class="row">
	<table class="table table-hover table-list-search">
		<thead>
			<tr>
				<th>Site</th>
				<th>Description</th>
			</tr>
		</thead>
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
</div>

<div class="row">
	<div class="col-md-1">
		<a href="/camps/addSite/<?php echo $camp['Camp']['id']; ?>/" class="btn btn-primary">Add Site</a>
	</div>
	<div class="col-md-1">
		<a href="/photos/" class="btn btn-primary">Photos</a>
	</div>
	<div class="col-md-10"></div>
</div>