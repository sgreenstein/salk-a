<?php 

echo $this->Form->create(array('action'=>'register'));
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('register');
?>