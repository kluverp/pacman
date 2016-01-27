<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');

class TextareaField extends Field
{	
	protected $cols      = 30;
	protected $rows      = 4;
	protected $maxlength = false;

	public function render()
	{
		return '
<div class="field">
	<label for="'. $this->name .'">'. $this->label . ($this->required ? '*' : '') .'</label>
	<textarea id="'. $this->name .'" name="'. $this->name .'" cols="'. $this->cols .'" rows="'. $this->rows .'" placeholder="'. $this->placeholder .'" required="'. $this->required .'" '. ($this->maxlength ? 'maxlength="'. $this->maxlength .'"' : '' ) .'>'. $this->value .'</textarea>
</div>';
	}
}


