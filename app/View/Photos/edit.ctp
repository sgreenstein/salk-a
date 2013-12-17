<div class="photos form">
	<?php echo $this->Form->create('Photo'); ?>
		<fieldset>
			<legend>
				<?php echo __('Edit Photo'); ?>
			</legend>
			<?php
				echo $this->Form->input('user_id',
					array('class' => 'form-control'));
				echo $this->Form->input('name',
					array(
						'class' => 'form-control',
						'type' => 'text'));
				echo $this->Form->input('description',
					array(
						'class' => 'form-control',
						'type' => 'text',
						'rows' => '3'));
				echo $this->Form->input('id', array('type' => 'hidden'));
			?>
		</fieldset>
	<?php
		$options = array('label' => 'Submit', 'class' => 'btn btn-primary');
		echo $this->Form->end($options);
	?>
</div>