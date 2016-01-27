<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');

class SlugField extends Field
{
	/**
	 * Default type
	 * @var string
	 */
	protected $type = 'text';
	
	/**
	 * Returns the field value
	 */
	public function getValue()
	{
		return slug($this->value);
	}
}


