<?php

namespace Pacman\lib\Form\Fields;

use Pacman\lib\Form\Field;

/**
 * Shows to inputs: lat and long and a marker map with the given coordintaes.
 *
 */
class LatLngField extends Field
{
	/**
	 * Holds the Select options array
	 * @var array
	 */
	protected $options = array();
	
	public function __construct($fieldName = '', $fieldConfig = array())
	{
		parent::__construct($fieldName, $fieldConfig);
		
		$this->init();
	}
	
	private function init()
	{
		$options = array();
		
	}
	
	/**
	 * Renders the field
	 */
	public function render()
	{
		return $this->wrap('
	<select id="'. $this->name .'" name="'. $this->name .'">
		'. $this->getEmptyOption() .'
		'. $this->renderOptions() .'
	</select>');
	}
}


