<!-- app/View/Camps/edit.ctp -->

<div class="camps form">
	<?php echo $this->Form->create('Camp'); ?>
		<fieldset>
			<legend>
				<?php echo __('Edit camp'); ?>
			</legend>
			<?php
				echo $this->Form->input('name',
					array('class' => 'form-control'));
				echo $this->Form->input('year',
					array(
						'class' => 'form-control',
						'value' => date('Y'),
						'empty' => false));
				echo $this->Form->input('description',
					array('class' => 'form-control'));
				echo $this->Form->input('id', array('type' => 'hidden'));
			?>
		</fieldset>
	<?php
		$options = array('label' => 'Submit', 'class' => 'btn btn-primary');
		echo $this->Form->end($options);
	?>
</div>