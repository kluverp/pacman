<?php


abstract class Field
{
	protected $type = 'text';
	protected $label = '';
	protected $required = false;
	protected $name = '';
	protected $value = '';
	protected $placeholder = '';
	protected $maxlength = 255;

	public function __construct($fieldName = '', $config = array())
	{
		$this->name = $fieldName;
		
		foreach ( $config as $key => $value )
		{
			$this->$key = $value;
		}
	}
	
	public function render()
	{

	}


}


