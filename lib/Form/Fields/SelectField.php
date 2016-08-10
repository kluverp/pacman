<?php

namespace Pacman\lib\Form\Fields;

use Pacman\lib\Form\Field;

class SelectField extends Field
{
	/**
	 * Holds the Select options array
	 *
	 * @var array
	 */
	protected $options = array();
	
	/**
	 * If set, allow an empty value
	 *
	 * @var bool
	 */
	protected $allowEmpty = false;
	
	/**
	 * The label for the empty option
	 * Can be set in TableConfig obj
	 *
	 * @var string
	 */
	protected $emptyLabel = '- choose -';
	
	/**
	 * Class Constructor
	 *
	 */
	public function __construct($fieldName = '', $fieldConfig = array())
	{
		// call parent constructor
		parent::__construct($fieldName, $fieldConfig);
		
		// parse the options string
		$this->parseOptions();
	}
	
	/**
	 * Parses the options string 
	 *
	 * @return array
	 */
	private function parseOptions()
	{
		$options = array();
		
		// parse the options string and split on pipe
		$rawOptions = explode('|', $this->options);
				
		// build the options array
		foreach ( $rawOptions as $o )
		{
			// explode the options str
			$values = explode(',', $o);
			$option['label'] = $values[0];
			$option['value'] = $values[1];
			$option['color'] = $values[2];

			// add parsed option
			$options[] = $option;
		}
		
		// set options array
		$this->options = $options;
	}
	
	/**
	 * Renders the field
	 */
	public function render()
	{
		return $this->wrap(sprintf('<select id="%s" name="%s">%s%s</select>', $this->getName(), $this->getName(), $this->renderEmptyOption(), $this->renderOptions()));
	}
	
	/**
	 * Renders the <option> tags for <select> field
	 *
	 * @return string
	 */
	public function renderOptions()
	{
		$str = '';
		
		// render each option value
		foreach ( $this->options as $option )
		{
			$str .= '<option value="'. $option['value'] .'">'. $option['label'] .'</option>';
		}
		
		return $str;
	}
	
	/**
	 * If 'allowEmpty' is set, we let the user choose the 'empty' value
	 *
	 * @return string
	 */
	private function renderEmptyOption()
	{
		// if flag is set
		if ( $this->allowEmpty ) {
			return '<option value="">'. $this->emptyLabel .'</option>';
		}
		
		return '';
	}
}


