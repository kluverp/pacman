<div id="header">

	<div id="logo">
		<img src="<?php echo url('public/img/pacman-logo_77x50.png'); ?>" alt="logo" />
	</div>
	
	<div class="breadcrumbs">
		<?php 
		$i = 1;
		$count = count($breadcrumbs);
	
		// render each breadcrumb
		foreach ( $breadcrumbs as $url => $title )
		{
			echo ( $i < $count ) ? '<a href="'. $url .'">'. $title .'</a> / ' : $title;

			$i++;
		}
		?>		
	</div>
	
	<div id="logout">
		<a href="<?php echo url('login/logout'); ?>">Logout</a>
	</div>
	
</div>