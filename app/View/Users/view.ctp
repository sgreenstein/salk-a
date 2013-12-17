
<div id="page-container" class="row">

	<div id="sidebar" class="col-sm-3">
		
		<div class="actions">
			
			<ul class="list-group">			
						<li class="list-group-item"><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id']), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array('class' => ''), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Users'), array('action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New User'), array('action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Campers'), array('controller' => 'campers', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Camper'), array('controller' => 'campers', 'action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Blogs'), array('controller' => 'blogs', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('List Photos'), array('controller' => 'photos', 'action' => 'index'), array('class' => '')); ?> </li>
		<li class="list-group-item"><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add'), array('class' => '')); ?> </li>
				
			</ul><!-- /.list-group -->
			
		</div><!-- /.actions -->
		
	</div><!-- /#sidebar .span3 -->
	
	<div id="page-content" class="col-sm-9">
		
		<div class="users view">

			<h2><?php  echo __('User'); ?></h2>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Camp Id'); ?></strong></td>
		<td>
			<?php echo h($user['User']['camp_id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Site Id'); ?></strong></td>
		<td>
			<?php echo h($user['User']['site_id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Username'); ?></strong></td>
		<td>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Password'); ?></strong></td>
		<td>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Level'); ?></strong></td>
		<td>
			<?php echo h($user['User']['level']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Profile Picture'); ?></strong></td>
		<td>
			<?php echo h($user['User']['profile_picture']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('First Name'); ?></strong></td>
		<td>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Last Name'); ?></strong></td>
		<td>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Camper Id'); ?></strong></td>
		<td>
			<?php echo h($user['User']['camper_id']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

						<div class="related">
					<h3><?php echo __('Related Campers'); ?></h3>
					<?php if (!empty($user['Camper'])): ?>
						<table class="table table-striped table-bordered">
							<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['id']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('User Id'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['user_id']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Insurance Card'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['insurance_card']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Birth Date'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['birth_date']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Background Check'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['background_check']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Shirt Size'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['shirt_size']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Camp Choice 1'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['camp_choice_1']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Camp Choice 2'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['camp_choice_2']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Camp Assignment'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['camp_assignment']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Site Assignment'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['site_assignment']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Paid'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['paid']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Application Complete'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['application_complete']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Accepted'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['accepted']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Address 1'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['address_1']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Address 2'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['address_2']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('City'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['city']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('State'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['state']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Zip'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['zip']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Email'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['email']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Phone'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['phone']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Cell Phone'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['cell_phone']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Church'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['church']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('District'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['district']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['created']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['modified']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Form Pdf'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['form_pdf']; ?>
&nbsp;</strong></td>
</tr><tr>		<td><strong><?php echo __('Assigned'); ?></strong></td>
		<td><strong><?php echo $user['Camper']['assigned']; ?>
&nbsp;</strong></td>
</tr>						</table><!-- /.table table-striped table-bordered -->
					<?php endif; ?>
					<div class="actions">
						<li><?php echo $this->Html->link(__('<i class="icon-pencil icon-white"></i> Edit Camper'), array('controller' => 'campers', 'action' => 'edit', $user['Camper']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
					</div><!-- /.actions -->
				</div><!-- /.related -->
						
			<div class="related">

				<h3><?php echo __('Related Blogs'); ?></h3>
				
				<?php if (!empty($user['Blog'])): ?>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
											<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
									<?php
										$i = 0;
										foreach ($user['Blog'] as $blog): ?>
		<tr>
			<td><?php echo $blog['id']; ?></td>
			<td><?php echo $blog['user_id']; ?></td>
			<td><?php echo $blog['title']; ?></td>
			<td><?php echo $blog['content']; ?></td>
			<td><?php echo $blog['created']; ?></td>
			<td><?php echo $blog['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'blogs', 'action' => 'view', $blog['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'blogs', 'action' => 'edit', $blog['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'blogs', 'action' => 'delete', $blog['id']), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $blog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
							</tbody>
						</table><!-- /.table table-striped table-bordered -->
					</div><!-- /.table-responsive -->
					
				<?php endif; ?>

				
				<div class="actions">
					<?php echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('New Blog'), array('controller' => 'blogs', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>				</div><!-- /.actions -->
				
			</div><!-- /.related -->

					
			<div class="related">

				<h3><?php echo __('Related Photos'); ?></h3>
				
				<?php if (!empty($user['Photo'])): ?>
					
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
											<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
									<?php
										$i = 0;
										foreach ($user['Photo'] as $photo): ?>
		<tr>
			<td><?php echo $photo['id']; ?></td>
			<td><?php echo $photo['user_id']; ?></td>
			<td><?php echo $photo['url']; ?></td>
			<td><?php echo $photo['name']; ?></td>
			<td><?php echo $photo['description']; ?></td>
			<td><?php echo $photo['created']; ?></td>
			<td><?php echo $photo['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'photos', 'action' => 'view', $photo['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'photos', 'action' => 'edit', $photo['id']), array('class' => 'btn btn-default btn-xs')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'photos', 'action' => 'delete', $photo['id']), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $photo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
							</tbody>
						</table><!-- /.table table-striped table-bordered -->
					</div><!-- /.table-responsive -->
					
				<?php endif; ?>

				
				<div class="actions">
					<?php echo $this->Html->link('<i class="icon-plus icon-white"></i> '.__('New Photo'), array('controller' => 'photos', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>				</div><!-- /.actions -->
				
			</div><!-- /.related -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->
