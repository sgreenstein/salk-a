<?php if($currentCard) {
echo 'Current insurance card:';
echo '<img src=/', $currentCard, '>';
} ?>
<?php
echo $this->Form->create('Camper', array('type' => 'file'));
echo $this->Form->input('insurance_card', array('type'=> 'file', 'accept' => 'image/*'));
echo $this->Form->end(__('Upload'));
?>

