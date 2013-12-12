<?php if($currentForm) {
echo '<a href=/', $currentForm, '>Download current form</a>';
} ?>
<?php
echo $this->Form->create('Camper', array('type' => 'file'));
echo $this->Form->input('form_pdf', array('type'=> 'file'));
echo $this->Form->end(__('Upload'));
?>

