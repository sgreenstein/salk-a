<!-- app/View/Camps/addSite.ctp -->

<div class="sites form">
	<?php echo $this->Form->create('Site', array('role' => 'form')); ?>
	<fieldset>
		<legend>
			<?php echo __('Create new site'); ?>
		</legend>
		<?php
			echo $this->Form->input('Site.name',
				array(
					'type' => 'text',
					'class' => 'form-control',
					'placeholder' => 'Site Name'
				));
			echo $this->Form->input('Site.description',
				array(
					'class' => 'form-control',
					'rows' => '3'
				));
			echo $this->Form->input('Site.campId', array('type' => 'hidden', 'value'));
		?>
	</fieldset>
	<?php
		$options = array('label' => 'Submit', 'class' => 'btn btn-primary');
		echo $this->Form->end($options);
	?>
</div>
