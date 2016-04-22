<?php

abstract class Field
{
	protected $type        = 'text';
	protected $label       = '&lt; label &gt;';
	protected $required    = false;
	protected $name        = '';
	protected $value       = '';
	protected $placeholder = '';
	protected $maxlength   = 255;
	protected $form_prefix = 'frm-';

	/**
	 * Class Constructor
	 *
	 * @param string $fielName
	 * @param array $config
	 */
	public function __construct($fieldName = '', $config = array(), $value = '')
	{
		// set name attr
		$this->setName($fieldName);
		
		// set the value
		$this->setValue($value);
		
		// set the rest of the attributes
		foreach ( $config as $key => $value )
		{
			$this->$key = $value;
		}
	}
	
	/**
	 * Renders the field to screen
	 *
	 * @return string
	 */
	public function render()
	{
		return '';
	}
	
	/**
	 * Wraps the final input in HTML
	 *
	 * @return string
	 */
	protected function wrap($input = '')
	{
	return '
<div class="field">
	<label for="'. $this->getId() .'">'. $this->getLabel() . ($this->getRequired() ? '*' : '') .'</label>
	'. $input .'
</div>';
	}
	
	/**
	 * Build the HTML attribute string
	 *
	 * @param array $atts
	 * @return array
	 */
	protected function getAtts($atts = array())
	{
		$str = '';
		
		// remove all empty values
		$atts = array_filter($atts);
		
		// build string with attributes
		foreach ($atts as $name => $value)
		{
			// if boolean value and set, add attr without value
			if (is_bool($value) && $value)
			{
				$str .= ' ' . $name;
			}
			else
			{
				$str .= ' ' . $name . '="'. $value .'"';
			}
		}
		
		return $str;
	}
	
	/**
	 * Set's the field name attr
	 *
	 * @return string
	 */
	public function setName($name = '')
	{
		return $this->name = $name;
	}
	
	/**
	 * Returns the field name prefixed with form_prefix. 
	 * The reason behind this, is to avoid CSS problems field ID's 
	 * having the same name as some local styling for the CMS.
	 *
	 * @return string
	 */
	public function getId()
	{
		return $this->form_prefix . $this->name;
	}
	
	/**
	 * Return the fieldname
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Set the field value
	 *
	 * @param mixed $value
	 * @return mixed
	 */
	public function setValue($value = '')
	{
		return $this->value = $value;
	}
	
	public function getValue()
	{
		return $this->value;
	}
	
	public function getPlaceholder()
	{
		return $this->placeholder;
	}
	
	public function getMaxlength()
	{
		return $this->maxlength;
	}
	
	public function getLabel()
	{
		return $this->label;
	}
	
	public function getRequired()
	{
		return $this->required;
	}
}


