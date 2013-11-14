<?php
echo $this->Form->create('Camper');
echo $this->Form->input('age');
echo $this->Form->input('Camp');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end(__('Submit'));
?>
