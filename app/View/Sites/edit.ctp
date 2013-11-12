<!-- app/View/Sites/edit.ctp -->
<div class="sites form">
<?php echo $this->Form->create('Site'); ?>
    <fieldset>
        <legend><?php echo __('Edit site'); ?></legend>
        <?php echo $this->Form->input('name');
        echo $this->Form->input('description');
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
