<?php
require_once(ROOT_PATH . 'lib/Form/Fields/SelectField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/CheckboxField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/EditorField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/InputField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/LatLngField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/RadioField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/SlugField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/TextareaField.php');


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
			case 'hidden':
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
			default:
				$class = ucfirst($fieldType);
		}
		
		// add the 'Field' suffix
		$class .= 'Field';
				
		// check if the class exists
        if (!class_exists($class))
		{
            throw new Exception('FormField class "'. $class .'" does not exist!');
        }
				
        return new $class($fieldname, $config, $value);
    }
}

