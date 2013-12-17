<div class="campers view">
<h2><?php echo __('Camper'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($camper['User']['id'], array('controller' => 'users', 'action' => 'view', $camper['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Insurance Card'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['insurance_card']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birth Date'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['birth_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Background Check'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['background_check']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shirt Size'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['shirt_size']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Camp Choice1'); ?></dt>
		<dd>
			<?php echo $this->Html->link($camper['CampChoice1']['name'], array('controller' => 'camps', 'action' => 'view', $camper['CampChoice1']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Camp Choice2'); ?></dt>
		<dd>
			<?php echo $this->Html->link($camper['CampChoice2']['name'], array('controller' => 'camps', 'action' => 'view', $camper['CampChoice2']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Camp Assignment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($camper['CampAssignment']['name'], array('controller' => 'camps', 'action' => 'view', $camper['CampAssignment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Site Assignment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($camper['SiteAssignment']['name'], array('controller' => 'sites', 'action' => 'view', $camper['SiteAssignment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['paid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application Complete'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['application_complete']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accepted'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['accepted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address 1'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['address_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address 2'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['address_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cell Phone'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['cell_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Church'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['church']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('District'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['district']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($camper['Camper']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Camper'), array('action' => 'edit', $camper['Camper']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Camper'), array('action' => 'delete', $camper['Camper']['id']), null, __('Are you sure you want to delete # %s?', $camper['Camper']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Campers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camper'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sites'), array('controller' => 'sites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Assignment'), array('controller' => 'sites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp Assignment'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Camps'); ?></h3>
	<?php if (!empty($camper['Camp'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($camper['Camp'] as $camp): ?>
		<tr>
			<td><?php echo $camp['id']; ?></td>
			<td><?php echo $camp['user_id']; ?></td>
			<td><?php echo $camp['name']; ?></td>
			<td><?php echo $camp['description']; ?></td>
			<td><?php echo $camp['created']; ?></td>
			<td><?php echo $camp['modified']; ?></td>
			<td><?php echo $camp['year']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'camps', 'action' => 'view', $camp['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'camps', 'action' => 'edit', $camp['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'camps', 'action' => 'delete', $camp['id']), null, __('Are you sure you want to delete # %s?', $camp['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>



<!-- TEST PAYPAL BUTTON -->
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="M9LYQGPXC3YXA">
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>






