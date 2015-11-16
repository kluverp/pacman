<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');

class TextField extends Field
{	
	protected $cols = 30;
	protected $rows = 4;

	public function render()
	{
		return '
<div class="field">
	<label for="'. $this->name .'">'. $this->label .'</label>
	<textarea id="'. $this->name .'" name="'. $this->name .'" cols="'. $this->cols .'" rows="'. $this->rows .'" placeholder="'. $this->placeholder .'">'. $this->value .'</textarea>
</div>';
	}


}


