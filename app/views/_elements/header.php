<div id="header">

	<div id="logo">
		<img src="" alt="logo" />
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