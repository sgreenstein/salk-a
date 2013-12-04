<!-- File: /app/View/Camps/index.ctp -->

<head>
	<?php echo $this->Html->script('libs/system-search'); ?>
</head>

<h1>Camps</h1>

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
		<th>Name</th>
		<th>Description</th>
		<th>Sites</th>
	</tr>
	<?php foreach ($camps as $camp): ?>
		<tr>
			<td>
				<a href='/camps/view/<?php echo $camp['Camp']['id'] ?>'>
					<?php echo $camp['Camp']['name']; ?>
				</a>
			</td>
			<td>
				<?php echo $camp['Camp']['description']; ?>
			</td>
			<td>
				<?php foreach ($camp['Site'] as $site) {
					echo $site['name'], " ";
				} ?>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php unset($camp); ?>
</table>

<a href="/camps/add" class="btn btn-primary">Add Camp</a>