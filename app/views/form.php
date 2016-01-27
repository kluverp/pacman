<h1><?php echo $this->data['title']; ?></h1>

<p><?php echo $this->data['description']; ?></p>

<div class="form-options-top">
	<a href="#">Nieuw</a> <!-- groene knop -->

	<a href="#">Cancel</a> <!-- witte knop -->
	<a href="#">Save</a> <!-- blauw of groene knop -->
</div>


<!-- het formulier zelf -->
<form action="<?php echo $data['formAction']; ?>" method="post">
	<?php echo $data['form']->render() ?>
	<input type="submit" value="Submit" />
</form>


<div class="form-options-bottom">
	<a href="#">Delete</a> <!-- rode knop -->

	<a href="#">Cancel</a> <!-- witte knop -->
	<a href="#">Save</a> <!-- blauwe knop -->
</div>