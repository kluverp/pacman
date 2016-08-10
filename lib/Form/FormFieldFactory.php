<?php
namespace Pacman\lib\Form;

use Pacman\lib\Form\Fields\SelectField;
use Pacman\lib\Form\Fields\CheckboxField;
use Pacman\lib\Form\Fields\EditorField;
use Pacman\lib\Form\Fields\InputField;
use Pacman\lib\Form\Fields\LatLngField;
use Pacman\lib\Form\Fields\RadioField;
use Pacman\lib\Form\Fields\SlugField;
use Pacman\lib\Form\Fields\TextareaField;
use Pacman\lib\Form\Fields\HeadingField;
use Pacman\lib\Form\Fields\HiddenField;

class FormFieldFactory
{
	/**
	 * Create the appropriate form field according to type
	 *
	 * @return Field Object
	 */
    public static function make($fieldType = '', $fieldname = '', $config = array(), $value = '')
    {
		// create fields based on fieldtype
		switch($fieldType)
		{			
			case 'latlng':
				$class = 'LatLng';				
				break;
			case 'input':			
			case 'text':
			case 'password':
			case 'button':
			case 'color':
			case 'date':
			case 'datetime':
			case 'datetime-local':
			case 'email':
			case 'month':
			case 'number':
			case 'range':
			case 'search':
			case 'tel':
			case 'time':
			case 'url':
			case 'week':
				$class = 'Input';
				break;
			case 'hidden':
				$class = 'Hidden';
				break;
			default:
				$class = ucfirst($fieldType);
		}
		
		// create new classname
		$class = __NAMESPACE__ . '\Fields\\'. $class . 'Field';
			
		// check if the class exists
        if (!class_exists($class))
		{
            throw new \Exception('FormField class "'. $class .'" does not exist!');
        }
				
        return new $class($fieldname, $config, $value);
    }
}

