<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');

class TextareaField extends Field
{	
	/**
	 * The cols attribute
	 * @var int
	 */
	protected $cols      = 30;
	
	/**
	 * The rows attr
	 * @var int
	 */
	protected $rows      = 4;

	/**
	 * Renders the field
	 * 
	 * @return string
	 */
	public function render()
	{
		// built the attribute string
		$attsStr = $this->getAtts(array(
			'id'          => $this->getName(),
			'name'        => $this->getName(),
			'cols'        => $this->getCols(),
			'rows'        => $this->getRows(),
			'placeholder' => $this->getPlaceholder(),
			'required'    => $this->getRequired(),
			'maxlength'   => $this->getMaxlength()
		));
		
		// returns the formatted HTML
		return $this->wrap(sprintf('<textarea%s>%s</textarea>', $attsStr, $this->getValue()));
	}
	
	/**
	 * Returns the cols attr
	 * 
	 * @return int
	 */
	private function getCols()
	{
		return $this->cols;
	}

	/**
	 * Returns the rows attr
	 * 
	 * @return int
	 */	
	private function getRows()
	{
		return $this->rows;
	}
}


