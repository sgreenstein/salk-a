<!-- app/View/log-in/register.ctp -->
<div class="log-in form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('level');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Register')); ?>
</div>
