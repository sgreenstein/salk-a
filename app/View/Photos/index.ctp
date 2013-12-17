<div class="photos index">
	<h2>
		<?php echo __('Photos'); ?>
	</h2>
	<p>
		<?php
			echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} of {:count} pictures: {:start} - {:end}')));
		?>
	</p>
	<table class="table table-hover table-list-search">
			<thead>
				<tr>
						<th>Id</th>
						<th>User Id</th>
						<th>Url</th>
						<th>Name</th>
						<th>Description</th>
						<th>Created</th>
						<th>Modified</th>
						<th>Actions</th>
				</tr>
			</thead>
		<?php foreach ($photos as $photo): ?>
			<tr>
				<td><?php echo h($photo['Photo']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($photo['User']['id'], array('controller' => 'users', 'action' => 'view', $photo['User']['id'])); ?>
				</td>
				<td><?php echo h($photo['Photo']['url']); ?>&nbsp;</td>
				<td><?php echo h($photo['Photo']['name']); ?>&nbsp;</td>
				<td><?php echo h($photo['Photo']['description']); ?>&nbsp;</td>
				<td><?php echo h($photo['Photo']['created']); ?>&nbsp;</td>
				<td><?php echo h($photo['Photo']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $photo['Photo']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $photo['Photo']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $photo['Photo']['id']), null, __('Are you sure you want to delete # %s?', $photo['Photo']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<a href="/photos/add/" class="btn btn-primary">Add Photo</a>
