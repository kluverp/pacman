<div id="login-wrapper">

	<div id="login">
		<form accept-charset="UTF-8" action="login" method="post">
			<fieldset>
				<legend><?php echo trans('app.login.forgotten'); ?></legend>
				
				<div class="field">
					<label for="email"><?php echo trans('app.login.email'); ?></label>
					<input type="email" id="email" name="email" value="" maxlength="255" />
				</div>
				
				<a href="<?php echo url('login/forgotpw'); ?>" style="float: right"><?php echo trans('app.login.password-forgotten'); ?></a>
			</fieldset>
		</form>
	</div>
	
	<div id="login-logo">
		<img alt="Pacman CMS" src="<?php echo img('pacman-logo_77x50.png'); ?>">
	</div>
	
</div>