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
<?php
	echo $this->Form->end(__('Submit'));
	$dir = $site['SiteDirector']['name'];
	if(!$dir)
		$dir = 'None';
	echo 'Current director: ', $dir;
	echo $this->Form->postLink('Change director', array('action' => 'chooseDirector', $site['Site']['id']));
?>
