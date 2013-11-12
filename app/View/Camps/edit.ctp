<!-- app/View/Camps/edit.ctp -->
<div class="camps form">
<?php echo $this->Form->create('Camp'); ?>
    <fieldset>
	<legend><?php echo __('Edit camp'); ?></legend>
	<?php
	echo $this->Form->input('name');
	echo $this->Form->input('year', array('value' => date('Y'), 'empty' => false));
	echo $this->Form->input('description');
	echo $this->Form->input('id', array('type' => 'hidden'));
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
