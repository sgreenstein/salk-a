<?php
echo $this->Form->create('Camper');
echo $this->Form->input('birth_date', array('minYear' => 1900, 'maxYear' => date('Y') - 14));
echo $this->Form->input('camp_choice_1');
echo $this->Form->input('camp_choice_2');
echo $this->Form->input('shirt_size');
echo $this->Form->input('address_1');
echo $this->Form->input('address_2');
echo $this->Form->input('city');
echo $this->Form->input('state');
echo $this->Form->input('zip');
echo $this->Form->input('email');
echo $this->Form->input('phone');
echo $this->Form->input('cell_phone');
echo $this->Form->input('church');
echo $this->Form->input('district');
echo $this->Form->end('Submit');
?>
