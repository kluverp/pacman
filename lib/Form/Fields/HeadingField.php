<?php

namespace Pacman\lib\Form\Fields;

use Pacman\lib\Form\Field;

/**
 * Heading Field
 *
 * Prints a heading <h2> between the form fields
 */
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


