<?php
echo $this->Form->create('Camper');
//echo $this->Form->input('user_id', array('type' => 'hidden'));
echo $this->Form->input('birth_date', array('minYear' => 1900, 'maxYear' => date('Y') - 14)); ?>
<label for=CamperShirtSize>Shirt Size</label>
<?php echo $this->Form->select('shirt_size', array('S'=>'S', 'M'=>'M', 'L'=>'L', 'XL'=>'XL', '2XL'=>'2XL', '3XL'=>'3XL', '4XL'=>'4XL'), array('escape' => false)); ?>
<br><label for=CamperCampChoice1>First choice of camp</label>
<?php echo $this->Form->select('camp_choice_1', $campChoices, array('empty' => false)); ?>
<br><label for=CamperCampChoice2>Second choice of camp</label>
<?php
echo $this->Form->select('camp_choice_2', $campChoices, array('empty' => false));
echo $this->Form->input('address_1',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('address_2',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('city',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('state',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('zip',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('email',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('phone',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('cell_phone',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('church',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('district',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->end('Submit');
?>