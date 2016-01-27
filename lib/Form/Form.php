<?php

require_once(ROOT_PATH . 'lib/Form/FormFieldFactory.php');

class Form
{
	/**
	 * The form configuration array
	 * 
	 * @var array()
	 */
	private $config = array();
	
	/**
	 * The array holding field objects
	 *
	 * @var array
	 */
	private $fields = array();

	/**
	 * Class Constructor
	 *
	 * Receives a configuration array telling our form what it should look like
	 *
	 */
	public function __construct($config = array())
	{
		// set the config obj
		$this->config = $config;
		
		// init the form
		$this->init();
	}

	/**
	 * Factory function to create a new form obj
	 *
	 * @param array $config
	 */
	public static function make($config = array())
	{
		return new self($config);
	}
	
	/**
	 * Init the form 
	 *
	 */
	public function init()
	{
		// loop over each defined field
		foreach ( $this->config as $fieldName => $fieldConfig )
		{
			// get the fieldtype from config file
			$fieldType = isset($fieldConfig['type']) ? $fieldConfig['type'] : false;
		
			// create new form field with Factory, and add to fields array
			if ( $field = FormFieldFactory::make($fieldType, $fieldName, $fieldConfig) )
			{
				$this->addField($field);
			}
		}
	}
	
	/**
	 * Adds a field to the fields array
	 *
	 */
	public function addField($field = false)
	{
		// check if a field obj is given
		if ( is_object($field) )
		{
			return $this->fields[] = $field;
		}
		
		return false;
	}
	
	/**
	 * Renders the form
	 *
	 * @return string
	 */
	public function render()
	{
		$str = '';
		
		// loop over all fields, and render each one
		foreach ( $this->fields as $field )
		{
			$str .= $field->render();
		}
		
		return $str;
	}
}