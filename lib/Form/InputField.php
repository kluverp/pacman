<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');

class InputField extends Field
{
	/**
	 * Default type
	 * @var string
	 */
	protected $type = 'text';
	
	/**
	 * Renders the field
	 */
	public function render()
	{
		return '
<div class="field">
	<label for="'. $this->name .'">'. $this->label .'</label>
	<input type="'. $this->type .'" id="'. $this->name .'" name="'. $this->name .'" value="'. $this->value .'" placeholder="'. $this->placeholder .'" maxlength="'. $this->maxlength .'" />
</div>';
	}
}


