<div id="login-wrapper">

	<div id="login">
		<form accept-charset="UTF-8" action="login" method="post">
			<fieldset>
				<legend>Sign in to Pacman</legend>
				<input name="_token" value="FIZAy3xeGnudohMQhIacf9DNiVDONAXvOuiW+RMTc0g=" type="hidden">
				
				<div class="field">
					<label for="email">E-mail</label>
					<input type="email" id="email" name="email" value="" maxlength="255" />
				</div>
				
				<div class="field">
					<label for="password">Wachtwoord</label>
					<input type="password" id="password" name="password" value="" maxlength="255" />
				</div>
				
				<div class="field">
					<input type="submit" value="Log in" />
				</div>
				
				<div class="remember">
					<input type="checkbox" checked="checked" id="remember_me" name="remember_me" value="1" />
					<label class="checkbox-label" for="remember_me">Remember me</label>
					<a href="<?php echo url('login/forgotpw'); ?>" style="float: right">Forgot Password?</a>
				</div>
			</fieldset>
		</form>
	</div>
	
	<div id="login-logo">
		<img alt="Pacman CMS" src="<?php echo img('pacman-logo_77x50.png'); ?>">
	</div>
	
</div>