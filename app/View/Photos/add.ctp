<div class="photos form">
	<?php echo $this->Form->create('Photo', array('type' => 'file')); ?>
	<fieldset>
		<legend>
			<?php echo __('Add Photo'); ?>
		</legend>
		<?php
			echo $this->Form->input('user_id',
					array('class' => 'form-control'));
			echo $this->Form->input('photo_data', array('type' => 'file'));
			echo $this->Form->input('name',
				array(
					'type' => 'text',
					'class' => 'form-control',
					'placeholder' => 'Camp Name'
				));
			echo $this->Form->input('description',
				array(
					'class' => 'form-control',
					'rows' => '3'
				));
		?>
	</fieldset>
	<?php
		$options = array('label' => 'Submit', 'class' => 'btn btn-primary');
		echo $this->Form->end($options);
	?>
</div>
