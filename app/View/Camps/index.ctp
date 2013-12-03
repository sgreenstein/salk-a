<!-- File: /app/View/Camps/index.ctp -->

<h1>Camps</h1>
<table class="table table-hover">
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