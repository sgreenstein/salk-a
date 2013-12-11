<?php
echo $this->Form->create('Camper');
echo $this->Form->input('Camp', array('value' => $choice1));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end(__('Submit'));
?>
