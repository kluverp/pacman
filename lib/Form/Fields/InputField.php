<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');

class InputField extends Field
{
	/**
	 * Default type
	 *
	 * @var string
	 */
	protected $type = 'text';

	/**
 	 * List of valid HTML5 input types
	 * 
	 * @var array
 	 */
	protected $valid_types = array('text', 'password', 'submit', 'radio', 'checkbox', 'button', 'color', 'date', 'datetime', 'datetime-local', 'email', 'month', 'number', 'range', 'search', 'tel', 'time', 'url', 'week');
	
	/**
	 * Renders the field
	 * 
	 * @return string
	 */
	public function render()
	{
		$attsStr = $this->getAtts(array(
			'type'        => $this->getType(),
			'id'          => $this->getId(),
			'name'        => $this->getName(),
			'value'       => $this->getValue(),
			'placeholder' => $this->getPlaceholder(),
			'maxlength'   => $this->getMaxlength()
		));
		
		// render the field
		return $this->wrap('<input'. $attsStr .'/>');
	}
	
	/**
	 * Returns the input type attribute
	 *
	 * @return string
	 */
	public function getType()
	{	
		// check if the field type is a valid HTML5 type
		if ( in_array($this->type, $this->valid_types) )
		{
			return $this->type;
		}
		
		return $this->type = 'text';
	}
}


