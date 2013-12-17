<!-- File: /app/View/Camps/index.ctp -->

<head>
	<?php echo $this->Html->script('libs/system-search'); ?>
</head>

<div class="row">
	<div class="col-md-8">
		<h1>Camps</h1>
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
				<th>Name</th>
				<th>Description</th>
				<th>Sites</th>
			</tr>
		</thead>
		<?php foreach ($camps as $camp): ?>
			<tr onClick="window.location.href = '/camps/view/<?php echo $camp['Camp']['id'] ?>'">
				<td>
					<?php echo $camp['Camp']['name']; ?>
				</td>
				<td>
					<?php echo $camp['Camp']['description']; ?>
				</td>
				<td>
					<?php foreach ($camp['Site'] as $site) {
						echo $site['name'], " ";
					} ?>
				</td>
				<td>
					<?php echo $this->Form->postLink('Delete', array('controller' => 'camps', 'action' => 'delete', $camp['Camp']['id']), array('confirm' => "This will delete the camp's sites, rosters, and events. This cannot be undone. Do you want to proceed?"))?>
				</td>
				<td>
					<a href="/camps/edit/<?php echo $camp['Camp']['id']; ?>/">Edit</a>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php unset($camp); ?>
	</table>
	<a href="/camps/add" class="btn btn-primary">Add Camp</a>
</div>