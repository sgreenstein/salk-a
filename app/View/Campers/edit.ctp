<!-- app/View/Campers/edit.ctp -->
<div class="campers form">
<?php echo $this->Form->create('Camper'); ?>
    <fieldset>
	<legend><?php echo __('Edit camper'); ?></legend>
	<?php
	echo $this->Form->input('birth_date');
	echo $this->Form->input('over_18');
	echo $this->Form->input('id', array('type' => 'hidden'));
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit'));
	echo $this->Form->postLink('Add an insurance card',
		array('action' => 'addInsuranceCard', $camper['Camper']['id']));
?>
</div>
