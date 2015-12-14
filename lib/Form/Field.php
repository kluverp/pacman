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
	public function __construct($fieldName = '', $config = array())
	{
		$this->name = $fieldName;
		
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
	 * Returns the field name prefixed with form_prefix. 
	 * The reason behind this, is to avoid CSS problems field ID's 
	 * having the same name as some local styling for the CMS.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->form_prefix . $this->name;
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


