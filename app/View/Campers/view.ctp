
<div id="page-container" class="row">

	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
			
			<ul class="list-group">			
						<li class="list-group-item"><?php echo $this->Html->link(__('Edit Camper'), array('action' => 'edit', $camper['Camper']['id']), array('class' => '')); ?> </li>
						<li class="list-group-item"><?php
if($camper['Camper']['accepted'])
	$acceptToggle = 'Revoke Camper Acceptance';
else
	$acceptToggle = 'Accept Camper';
		echo $this->Form->postLink(__($acceptToggle), array('action' => 'toggleAcceptance', $camper['Camper']['id']), array('class' => '')); ?> </li>
						<li class="list-group-item"><?php
if($camper['Camper']['paid'])
	$paidToggle = 'Mark as having not paid';
else
	$paidToggle = 'Mark as having paid';
		echo $this->Form->postLink(__($paidToggle), array('action' => 'togglePaid', $camper['Camper']['id']), array('class' => '')); ?> </li>
						<li class="list-group-item"><?php
if($camper['Camper']['background_check'])
	$bcToggle = 'Mark background check incomplete';
else
	$bcToggle = 'Mark background check complete';
echo $this->Form->postLink(__($bcToggle), array('action' => 'toggleBackgroundCheck', $camper['Camper']['id']), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Form->postLink(__('Delete Camper'), array('action' => 'delete', $camper['Camper']['id']), array('class' => ''), __('Are you sure you want to delete # %s?', $camper['Camper']['id'])); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Campers'), array('action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Camper'), array('action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Sites'), array('controller' => 'sites', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Site Assignment'), array('controller' => 'sites', 'action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Camp Assignment'), array('controller' => 'camps', 'action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('class' => '')); ?> </li>
				
			</ul><!-- /.list-group -->
			
		</div><!-- /.actions -->
		
	</div><!-- /#sidebar .span3 -->
	
	<div id="page-content" class="col-sm-9">
		
		<div class="campers view">

			<h2><?php  echo __('Camper'); ?></h2>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('User'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($camper['User']['id'], array('controller' => 'users', 'action' => 'view', $camper['User']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Insurance Card'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['insurance_card']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Birth Date'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['birth_date']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Background Check'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['background_check']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Shirt Size'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['shirt_size']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Camp Choice1'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($camper['CampChoice1']['name'], array('controller' => 'camps', 'action' => 'view', $camper['CampChoice1']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Camp Choice2'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($camper['CampChoice2']['name'], array('controller' => 'camps', 'action' => 'view', $camper['CampChoice2']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Camp Assignment'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($camper['CampAssignment']['name'], array('controller' => 'camps', 'action' => 'view', $camper['CampAssignment']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Site Assignment'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($camper['SiteAssignment']['name'], array('controller' => 'sites', 'action' => 'view', $camper['SiteAssignment']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Paid'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['paid']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Application Complete'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['application_complete']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Accepted'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['accepted']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Address 1'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['address_1']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Address 2'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['address_2']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('City'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['city']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('State'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['state']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Zip'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['zip']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Email'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['email']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Phone'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['phone']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Cell Phone'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['cell_phone']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Church'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['church']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('District'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['district']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['modified']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Form Pdf'); ?></strong></td>
		<td>
			<?php echo h($camper['Camper']['form_pdf']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

					
			<div class="related">

				<h3><?php echo __('Related Camps'); ?></h3>
				
				<?php if (!empty($camper['Camp'])): ?>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
											<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Year'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
									<?php
										$i = 0;
										foreach ($camper['Camp'] as $camp): ?>
		<tr>
			<td><?php echo $camp['id']; ?></td>
			<td><?php echo $camp['user_id']; ?></td>
			<td><?php echo $camp['name']; ?></td>
			<td><?php echo $camp['description']; ?></td>
			<td><?php echo $camp['created']; ?></td>
			<td><?php echo $camp['modified']; ?></td>
			<td><?php echo $camp['year']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'camps', 'action' => 'view', $camp['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'camps', 'action' => 'edit', $camp['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'camps', 'action' => 'delete', $camp['id']), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $camp['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
							</tbody>
						</table><!-- /.table table-striped table-bordered -->
					</div><!-- /.table-responsive -->
					
				<?php endif; ?>

				
				<div class="actions">
					<?php echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('New Camp'), array('controller' => 'camps', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>				</div><!-- /.actions -->
				
			</div><!-- /.related -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
