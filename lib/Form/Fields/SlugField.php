<?php

namespace Pacman\lib\Form\Fields;

use Pacman\lib\Form\Field;

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


