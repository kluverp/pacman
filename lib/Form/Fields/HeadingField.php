<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');

class HeadingField extends Field
{
	/**
	 * Renders the field
	 * 
	 * @return string
	 */
	public function render()
	{	
		// render the field
		return '<h2>'. $this->label . '</h2>';
	}
}


