<!doctype html>
<html class="no-js" lang="">
    <head>
		<base href="<?php echo url(); ?>" />
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $HTMLTitle; ?> | <?php echo APP_TITLE; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" type="image/png" href="<?php echo url('favicon.ico') ?>">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/<?php echo STYLE; ?>/main.css">
		<?php
		foreach ( $styles as $style )
		{
			echo '<link rel="stylesheet" href="'. $style .'">';
		}
		?>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <?php
        if(is_file(__DIR__ . "/../_layouts/$layout.php")) {
            include(__DIR__ . "/../_layouts/$layout.php");
        } else {
            throw new Exception('Cannot locate layout!');
        }
        
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <!--<script src="js/main.js"></script>-->
    </body>
</html>
