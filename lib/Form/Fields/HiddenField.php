<?php

namespace Pacman\lib\Form\Fields;

use Pacman\lib\Form\Field;

/**
 * Hidden form input field
 */
class HiddenField extends Field
{
	/**
	 * Renders the field
	 * 
	 * @return string
	 */
	public function render()
	{
		$attsStr = $this->getAtts(array(
			'type'        => $this->type,
			'name'        => $this->getName(),
			'value'       => $this->getValue()
		));
		
		// render the field
		return '<input'. $attsStr .'/>';
	}
}


