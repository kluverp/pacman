<?php
require_once(ROOT_PATH . 'lib/Form/Fields/TextareaField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/SelectField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/RadioField.php');
require_once(ROOT_PATH . 'lib/Form/Fields/CheckboxField.php');

class FormFieldFactory
{
	/**
	 * Create the appropriate form field according to type
	 *
	 * @return Field Object
	 */
    public static function create($fieldType = '', $fieldname = '', $config = array())
    {
		// create fields based on fieldtype
		switch($fieldType)
		{			
			case 'latlng':
				$class = 'LatLng';				
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
				
        return new $class($fieldname, $config);
    }
}

