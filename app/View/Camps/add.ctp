<!-- app/View/Camps/add.ctp -->

<div class="camps form">
	<?php echo $this->Form->create('Camp', array('role' => 'form')); ?>
	<fieldset>
		<legend>
			<?php echo __('Create new camp'); ?>
		</legend>
		<?php
			echo $this->Form->input('name',
				array(
					'type' => 'text',
					'class' => 'form-control',
					'placeholder' => 'Camp Name'
				));
			echo $this->Form->input('year',
				array(
					'empty' => false,
					'value' => date('Y'),
					'class' => 'form-control',
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