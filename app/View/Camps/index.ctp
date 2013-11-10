<!-- File: /app/View/Camps/index.ctp -->

<h1>Camps</h1>
<table>
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Created</th>
		<th>Modified</th>
	</tr>
	<?php foreach ($camps as $camp): ?>
	<tr>
		<td><?php echo $camp['Camp']['name']; ?></td>
		<td><?php echo $camp['Camp']['description']; ?></td>
		<td>created</td>
		<td>modified</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($camp); ?>
</table>
