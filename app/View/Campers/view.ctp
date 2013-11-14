<h1>Camper <?php echo $camper['Camper']['id'] ?></h1>
<?php
echo $this->Form->postLink('Edit', array(
	'action' => 'edit', $camper['Camper']['id'])
);
echo $this->Form->postLink('Assign to camp', array(
	'action' => 'assignCamp', $camper['Camper']['id'], 21)
);
?>
