<?php

namespace Pacman\lib\Form;

use Pacman\lib\Input\Input;

/**
 * Validation Class
 * 
 * Used for validation input fields. Heavily inspired by the Laravel framework validator.
 * 
 *
 * Example Usage:
 *
 * $rules = [
 * 	'username' => 'required|email',
 * 	'password' => 'required|min:1|max:3'
 * ];
 *
 * $messages = [
 *     'username' => [
 *		'required' => 'Dit veld is verplicht',
 *		'email'    => 'Dit is geen correct e-mail adres'
 *	],
 * 	'password' => [
 * 		'required' => 'Het wachtwoord veld is verplicht',
 * 		'numeric'  => 'Dit is geen geldig getal'
 *    ]
 * ];
 *
 */
class Validator
{
	/**
	 * Array holding the validation rules
	 * @var array
	 */
	private $rules = [];
	
	/**
	 * Array holding the error messages
	 * @var array
	 */
	private $messages = [];
	
	/**
	 * The Input class
	 * @var obj
	 */
	private $inputs = [];
	
	/**
	 * Flag indicating validation passed
	 * @var bool
	 */
	private $pass = true;
	
	/**
	 * Array holding validation errors
	 * @var array
	 */
	private $errors = [];

	/**
	 * Class Constructor
	 *
	 * @param array $rules
	 * @param array $messages
	 */
	public function __construct($inputs, $rules, $messages = [])
	{
		// set rules
		$this->rules = $rules;
		
		// set messages
		$this->messages = $messages;
		
		// set inputs to validate
		$this->inputs = $inputs;
	}
	
	/**
	 * Factory: returns new instance of Validator class
	 *
	 * @param array $rules
	 * @param array $messages
	 *
	 * @return obj
	 */
	public static function make($inputs = [], $rules = [], $messages = [])
	{
		return new self($inputs, $rules, $messages);
	}
	
	/**
	 * Check if the validation passes 
	 *
	 */
	public function passes()
	{		
		// loop over each rule
		foreach ( $this->getRules() as $field => $ruleStr )
		{
			// explode rules to array
			$rules = explode('|', $ruleStr);
			
			// check each field
			$this->checkField($field, $this->getInput($field), $rules);
		}
		
		return $this->pass;
	}
	
	/**
	 * Returns the input field under validation
	 *
	 * @param string $field
	 * @return mixed
	 */
	private function getInput($field = '')
	{
		// check if entry is set
		if ( isset($this->inputs[$field]) )
		{
			return $this->inputs[$field];
		}
		
		return false;
	}
	
	/**
	 * Check if the field passes the validation
	 *
	 * @param string $field 
	 * @param mixed $value
	 * @param array $rules 
	 *
	 * @return bool
	 */
	private function checkField($field, $value, $rules)
	{
		// loop over each rule
		foreach ( $rules as $rule )
		{
			// explode the options
			$options = explode(':', $rule);
					
			// set pass flag to false if one or more rules fail
			if ( !$this->applyRule($options, $value) )
			{			
				// add error message
				$this->addError($field, $options[0]);
			
				// set the validation flag to false
				$this->pass = false;
			}
		}
		
		return $this->pass;
	}
	
	/**
	 * Apply the rule to the field for validation
	 *
	 * @param string $rule
	 * @param mixed $value
	 *
	 * @return bool
	 */
	private function applyRule($options = '', $value = false)
	{
		switch(strtolower($options[0]))
		{
			case 'required':
				return $this->ruleRequired($value);
			break;
			case 'email':
				return $this->ruleEmail($value);
			break;
			case 'numeric':
				return $this->ruleNumeric($value);
			break;
			case 'min':
				return $this->ruleMin($value, $options);
			break;
			case 'max':
				return $this->ruleMax($value, $options);
			break;
			default: 
				return true;
		}
	}
	
	/**
	 * E-mail validation rule
	 *
	 * @param string $value
	 * @return bool
	 */
	private function ruleEmail($value = '')
	{
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}
	
	/**
	 * Required validation rule
	 *
	 * @param string $value
	 * @return bool
	 */
	private function ruleRequired($value = false)
	{
		return !empty($value);
	}
	
	/**
	 * Numeric validation rule
	 *
	 * @param string $value
	 * @return bool
	 */		
	private function ruleNumeric($value = 0)
	{
		return is_numeric($value);
	}
	
	/**
	 * Min validation rule
	 *
	 * @param string $value
	 * @return bool
	 */		
	private function ruleMin($value = 0, $options = array())
	{
		// make sure the user entered a valid option
		if ( ! isset($options[1]) )
		{
			throw new \Exception('Please supply a valid number for the "min" rule!');
		}
		
		// handle string value differently than numeric values
		if ( is_string($value) )
		{
			return strlen($value) > $options[1];
		}
		else {
			return $value > $options[1];
		}
	}

	/**
	 * Max validation rule
	 *
	 * @param string $value
	 * @return bool
	 */			
	private function ruleMax($value = 0, $options = array())
	{
		// make sure the user entered a valid option
		if ( ! isset($options[1]) )
		{
			throw new \Exception('Please supply a valid number for the "max" rule!');
		}
		
		// handle string value differently than numeric values
		if ( is_string($value) )
		{
			return strlen($value) < $options[1];
		}
		else {
			return $value < $options[1];
		}
	}
	
	/**
	 * Returns the user defined validation rules
	 *
	 * @return array
	 */
	public function getRules()
	{
		return $this->rules;
	}
	
	/**
	 * Returns the validation errors array
	 *
	 * @return array
	 */
	public function getErrors()
	{
		return $this->errors;
	}
	
	/**
	 * Add a validation error
	 *
	 * @param string $field 	The input field name
	 * @param string $rule 		The validation rule for this field name
	 *
	 * @return array
	 */
	private function addError($field = '', $rule = '')
	{
		// check if an error message is set for given field name, and validation rule
		// if so, we add the message to the validation errors array
		if ( isset($this->messages[$field][$rule]) )
		{
			return $this->errors[$field][] = $this->messages[$field][$rule];
		}
		
		// fallback, add default error message
		return $this->errors[$field][] = $this->getDefaultErrorMsg($rule);
	}
	
	/**
	 * Returns a default error message if no custom error message is given
	 *
	 * @param string $rule 
	 *
	 * @return string
	 */
	private function getDefaultErrorMsg($rule = '')
	{
		$messages = [
			'required' => 'This field is required',
			'email'    => 'This is not a valid e-mail address',
			'numeric'  => 'This is not a valid number',
			'min'      => 'The value/length is too small',
			'max'      => 'The value/length is too large'
		];
		
		return isset($messages[$rule]) ? $messages[$rule] : 'Invalid';
	}
	

}