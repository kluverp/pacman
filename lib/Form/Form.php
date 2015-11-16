<?php

require_once(ROOT_PATH . 'lib/Form/InputField.php');
require_once(ROOT_PATH . 'lib/Form/TextField.php');
require_once(ROOT_PATH . 'lib/Form/RadioField.php');
require_once(ROOT_PATH . 'lib/Form/CheckboxField.php');

class Form {

	private $config = array();
	private $fields = array();

	public function __construct($config = array())
	{
		$this->config = $config;
		
		$this->init();
	}

	public static function make($config = array())
	{
		return new self($config);
	}
	
	public function init()
	{
		foreach ( $this->config as $fieldName => $fieldConfig )
		{
			switch($fieldConfig['type'])
			{
				case 'input':
					$this->addField(new InputField($fieldName, $fieldConfig));
					break;
				case 'text':
					$this->addField(new TextField($fieldName, $fieldConfig));
					break;
				case 'select':
					$this->addField(new SelectField($fieldName, $fieldConfig));
					break;
				case 'radio':
					$this->addField(new RadioField($fieldName, $fieldConfig));
					break;
				case 'checkbox':
					$this->addField(new CheckboxField($fieldName, $fieldConfig));
					break;
				default:
					$this->addField(new InputField($fieldName, $fieldConfig));
			}
		}
	}
	
	public function addField($field = false)
	{
		if ( $field )
		{
			$this->fields[] = $field;
		}
	}
	
	public function render()
	{
		$str = '';
		
		foreach ( $this->fields as $field )
		{
			$str .= $field->render();
		}
		
		return $str;
	}
}