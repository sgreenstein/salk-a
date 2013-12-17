<h2>
	<?php echo h($photo['Photo']['name']); ?>
</h2>

<div class="photos view">
	<?php echo $this->Html->image($photo['Photo']['url']); ?>
	<div class="row">
		<div class="col-md-1">
			<?php echo $this->Form->postLink('Delete', array('class' => 'btn btn-primary', 'action' => 'delete', $photo['Photo']['id']), null, __('Are you sure you want to delete # %s?', $photo['Photo']['id'])); ?>
		</div>
		<div class="col-md-1">
			<a href="/photos/edit/<?php echo $photo['Photo']['id']; ?>/">Edit</a>
		</div>
		<div class="col-md-10"></div>
	</div>
	<p>
		<?php echo h($photo['Photo']['description']); ?>
	</p>
</div>