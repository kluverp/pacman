<h1><?php echo $data['title']; ?></h1>

<p><?php echo $data['description']; ?></p>

<hr class="hr">

<!-- buttons top -->
<div class="form-options form-options-top">
	<a class="frm-options-delete" href="#">Delete</a>
</div>


<!-- form -->
<form id="frm" action="<?php echo $data['formAction']; ?>" method="post" enctype="multipart/form-data">
	<?php echo $data['form']->render() ?>
</form>

<!-- buttons bottom -->
<div class="form-options form-options-bottom">
	<a class="frm-options-cancel" href="#">Cancel</a>
	<button class="frm-options-save" type="submit" form="frm">Save</button>
</div>