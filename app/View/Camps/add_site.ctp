<!-- app/View/Camps/addSite.ctp -->
<div class="sites form">
<?php echo $this->Form->create('Site'); ?>
    <fieldset>
        <legend><?php echo __('Create new site'); ?></legend>
        <?php echo $this->Form->input('Site.name');
	echo $this->Form->input('Site.description');
//	echo $this->Form->input('Site.campId', array('type' => 'hidden', 'value'));
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
