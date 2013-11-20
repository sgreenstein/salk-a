<!-- File: /app/View/Campers/index.ctp -->

<h1>Campers</h1>
<table>
	<tr>
		<th>Email Address</th>
		<th>Date of Birth</th>
		<th>Created</th>
		<th>Modified</th>
	</tr>
	<?php foreach ($campers as $camper): ?>
	<tr>
		<td><?php echo $camper['Camper']['email']; ?></td>
		<td><?php echo $camper['Camper']['birth_date']; ?></td>
		<td><?php echo $camper['Camper']['created']; ?></td>
		<td><?php echo $camper['Camper']['modified']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($camper); ?>
</table>
