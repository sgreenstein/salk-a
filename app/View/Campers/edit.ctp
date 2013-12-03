<div class="campers form">
<?php
echo $this->Form->create('Camper');
//echo $this->Form->input('user_id', array('type' => 'hidden'));
echo $this->Form->input('birth_date', array('minYear' => 1900, 'maxYear' => date('Y') - 14)); ?>
<label for=CamperShirtSize>Shirt Size</label>
<?php echo $this->Form->select('shirt_size', array('S'=>'S', 'M'=>'M', 'L'=>'L', 'XL'=>'XL', '2XL'=>'2XL', '3XL'=>'3XL', '4XL'=>'4XL'), array('escape' => false)); ?>
<label for=CamperCampChoice1>First choice of camp</label>
<?php echo $this->Form->select('camp_choice_1', $campChoices, array('empty' => false)); ?>
<label for=CamperCampChoice2>Second choice of camp</label>
<?php
echo $this->Form->select('camp_choice_2', $campChoices, array('empty' => false));
echo $this->Form->input('address_1');
echo $this->Form->input('address_2');
echo $this->Form->input('city');
echo $this->Form->input('state');
echo $this->Form->input('zip');
echo $this->Form->input('email');
echo $this->Form->input('phone');
echo $this->Form->input('cell_phone');
echo $this->Form->input('church');
echo $this->Form->input('district');
echo $this->Form->end(__('Submit'));
?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Camper.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Camper.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Campers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Insurance Cards'), array('controller' => 'insurance_cards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Insurance Card'), array('controller' => 'campers', 'action' => 'addInsuranceCard', $camper['Camper']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sites'), array('controller' => 'sites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Assignment'), array('controller' => 'sites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp Assignment'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
