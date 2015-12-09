<h1><?php echo ucfirst($this->data['table']->getTitle()); ?></h1>

<p><?php echo ucfirst($this->data['table']->getDescription()); ?></p>

<?php 

	echo $this->data['table']->render();

?>