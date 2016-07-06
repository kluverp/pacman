<div id="login-wrapper">

	<div id="login">
		<form accept-charset="UTF-8" action="login" method="post">
			<fieldset>
				<legend><?php e(trans('app.login.forgotten')); ?></legend>
				
				<div class="field">
					<label for="email"><?php e(trans('app.login.email')); ?></label>
					<input type="email" id="email" name="email" value="" maxlength="255" />
				</div>
				
				<div class="field">
					<input type="submit" value="<?php echo trans('app.login.submit'); ?>" />
				</div>
				
				<a href="<?php e(url('login')); ?>" style="float: right"><?php e(trans('app.login.back')); ?></a>
			</fieldset>
		</form>
	</div>
	
	<div id="login-logo">
		<img alt="Pacman CMS" src="<?php e(img('pacman-logo_77x50.png')); ?>">
	</div>
	
</div>