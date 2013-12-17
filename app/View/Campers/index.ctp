<div class="campers index">
	<h2><?php echo __('Campers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<?php foreach ($campers as $camper): ?>
	<tr>
		<td><?php echo h($camper['Camper']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($camper['User']['id'], array('controller' => 'users', 'action' => 'view', $camper['User']['id'])); ?>
		</td>
		<td><?php echo h($camper['Camper']['insurance_card']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['birth_date']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['age']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['over_18']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['background_check']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['shirt_size']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($camper['CampChoice1']['name'], array('controller' => 'camps', 'action' => 'view', $camper['CampChoice1']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($camper['CampChoice2']['name'], array('controller' => 'camps', 'action' => 'view', $camper['CampChoice2']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($camper['CampAssignment']['name'], array('controller' => 'camps', 'action' => 'view', $camper['CampAssignment']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($camper['SiteAssignment']['name'], array('controller' => 'sites', 'action' => 'view', $camper['SiteAssignment']['id'])); ?>
		</td>
		<td><?php echo h($camper['Camper']['paid']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['application_complete']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['accepted']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['address_1']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['address_2']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['city']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['state']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['zip']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['email']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['phone']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['cell_phone']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['church']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['district']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['created']); ?>&nbsp;</td>
		<td><?php echo h($camper['Camper']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $camper['Camper']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $camper['Camper']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $camper['Camper']['id']), null, __('Are you sure you want to delete # %s?', $camper['Camper']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Camper'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sites'), array('controller' => 'sites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Assignment'), array('controller' => 'sites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp Assignment'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
