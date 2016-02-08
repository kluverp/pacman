<h1><?php echo $data['title']; ?></h1>

<p><?php echo $data['description']; ?></p>

<!-- buttons top -->
<div class="form-options form-options-top">
	<a class="frm-options-create" href="#">Nieuw</a>  <!-- groene knop -->
	<a class="frm-options-cancel" href="#">Cancel</a> <!-- witte knop -->
	<a class="frm-options-save" href="#">Save</a>     <!-- blauw of groene knop -->
</div>


<!-- form -->
<form action="<?php echo $data['formAction']; ?>" method="post">
	<?php echo $data['form']->render() ?>
	<input type="submit" value="Opslaan" />
</form>

<!-- buttons bottom -->
<div class="form-options form-options-bottom">
	<a class="frm-options-delete" href="#">Delete</a> <!-- rode knop -->
	<a class="frm-options-cancel" href="#">Cancel</a> <!-- witte knop -->
	<a class="frm-options-save" href="#">Save</a>     <!-- blauwe knop -->
</div>