<div id="login-wrapper">

	<div id="login">
		<form accept-charset="UTF-8" action="login" method="post">
			<fieldset>
				<legend><?php echo trans('app.login.legend'); ?></legend>
				
				<?php if ( session()->pull('auth_incorrect') ) { ?>
				<div class="message">
					<?php e(trans('app.login.incorrect')); ?>
				</div>
				<?php } ?>
								
				<div class="field <?php /*echo $errors.has('email') ? ' error' : '';*/ ?>">
					<label for="email"><?php echo trans('app.login.email'); ?></label>
					<input type="email" id="email" name="email" value="<?php e(old('email')); ?>" maxlength="255" />
				</div>
				
				<div class="field">
					<label for="password"><?php echo trans('app.login.password'); ?></label>
					<input type="password" id="password" name="password" value="" maxlength="255" />
				</div>
								
				<div class="remember">
					<input type="checkbox" checked="checked" id="remember_me" name="remember_me" value="1" />
					<label class="checkbox-label" for="remember_me"><?php echo trans('app.login.remember-me'); ?></label>
				</div>
				
				<div class="field">
					<input type="submit" value="<?php echo trans('app.login.submit'); ?>" />
				</div>
				<a href="<?php echo url('login/forgotten'); ?>" style="float: right"><?php echo trans('app.login.password-forgotten'); ?></a>
			</fieldset>
		</form>
	</div>
	
	<div id="login-logo">
		<img alt="Pacman CMS" src="<?php echo img('pacman-logo_77x50.png'); ?>">
	</div>
	
</div>