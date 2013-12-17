<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add Camper'); ?></legend>
        <?php echo $this->Form->input('username',
	array(
		'type' => 'text',
		'class' => 'form-control'));
        echo $this->Form->input('password',
	array(
		'type' => 'text',
		'class' => 'form-control'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>