<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');

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
		return '
<div class="field">
	<label for="'. $this->name .'">'. $this->label .'</label>
	<select id="'. $this->name .'" name="'. $this->name .'">
		'. $this->getEmptyOption() .'
		'. $this->renderOptions() .'
	</select>
</div>';
	}
}


