<!-- app/View/Users/edit.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Edit User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
        echo $this->Form->input('level');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>