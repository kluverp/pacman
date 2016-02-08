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
	 * The database record
	 *
	 * @var array
	 */
	private $data = null;

	/**
	 * Class Constructor
	 *
	 * Receives a configuration array telling our form what it should look like
	 *
	 */
	public function __construct($config = array(), $data)
	{
		// set the config obj
		$this->config = $config;
		
		// set data
		$this->data = $data;
		
		// init the form
		$this->init();
	}

	/**
	 * Factory function to create a new form obj
	 *
	 * @param array $config
	 */
	public static function make($config = array(), $data = false)
	{
		return new self($config, $data);
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
			
			// get the field value
			$fieldValue = $this->getFieldValue($fieldName);
		
			// create new form field with Factory, and add to fields array
			if ( $field = FormFieldFactory::make($fieldType, $fieldName, $fieldConfig, $fieldValue) )
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
	
	private function getFieldValue($fieldName)
	{		
		if ( isset($_POST[$fieldName]) )
		{
			return $_POST[$fieldName];
		}
		
		if ( isset($this->data[$fieldName] ) )
		{
			return $this->data[$fieldName];
		}
		
		return false;
	}
}