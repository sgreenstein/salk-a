<!-- app/View/Camps/add.ctp -->
<div class="camps form">
<?php echo $this->Form->create('Camp'); ?>
    <fieldset>
        <legend><?php echo __('Create new camp'); ?></legend>
	<?php
	echo $this->Form->input('name');
	echo $this->Form->input('year', array('empty' => false, 'value' => date('Y')));
	echo $this->Form->input('description');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
