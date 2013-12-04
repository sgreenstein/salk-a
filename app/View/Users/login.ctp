<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to continue to Salkehatchie</h1>
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<?php
					echo $this->Form->input('username',
						array(
						'type' => 'text',
						'class' => 'form-control',
						'placeholder' => 'Username'
					));
					echo $this->Form->input('password',
						array(
						'type' => 'password',
						'class' => 'form-control',
						'placeholder' => 'Password'
					));
				?>
			</fieldset>
			<?php
				$options = array('label' => 'Submit', 'class' => 'btn btn-primary btn-block');
				echo $this->Form->end($options);
			?>
			<div>
				<a href="/users/addCamper/" class="text-center new-account">Create an account </a>
			</div>
        </div>
    </div>
</div>