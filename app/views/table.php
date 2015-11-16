<h1><?php echo ucfirst($this->table->getTitle()); ?></h1>

<p><?php echo ucfirst($this->table->getDescription()); ?></p>

<?php 

	echo $this->table->render();

?>