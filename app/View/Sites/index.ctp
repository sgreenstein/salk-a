<!-- File: /app/View/Sites/index.ctp -->

<h1>Sites</h1>
<table>
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Created</th>
		<th>Modified</th>
	</tr>
	<?php foreach ($sites as $site): ?>
	<tr>
		<td><?php echo $site['Site']['name']; ?></td>
		<td><?php echo $site['Site']['description']; ?></td>
		<td>created</td>
		<td>modified</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($site); ?>
</table>
