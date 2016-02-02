<h1><?php echo ucfirst($data['table']->getTitle()); ?></h1>

<p><?php echo ucfirst($data['table']->getDescription()); ?></p>

<?php 

	echo $data['table']->render();

?>