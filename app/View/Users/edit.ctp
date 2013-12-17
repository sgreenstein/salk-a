<!-- app/View/Users/edit.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
   <fieldset>
       <legend><?php echo __('Edit User'); ?></legend>
       <?php echo $this->Form->input('username',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('password',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('confirm_password', 
	array(
		'type' => 'password',
		'class' => 'form-control'));
echo $this->Form->input('first_name',
	array(
		'type' => 'text',
		'class' => 'form-control'));
echo $this->Form->input('last_name',
	array(
		'type' => 'text',
		'class' => 'form-control'));
       $user = $this->Session->read('Auth.User');
       if ($user['level'] == 100)
           echo $this->Form->input('level');
   ?>
   </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>