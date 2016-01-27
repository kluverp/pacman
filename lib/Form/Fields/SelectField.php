<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');

class SelectField extends Field
{
	/**
	 * Holds the Select options array
	 * @var array
	 */
	protected $options = array();
	
	/**
	 * If set, allow an empty value
	 * @var bool
	 */
	protected $allowEmpty = false;
	
	/**
	 * The label for the empty option
	 * @var string
	 */
	protected $emptyLabel = '- kies -';
	
	public function __construct($fieldName = '', $fieldConfig = array())
	{
		parent::__construct($fieldName, $fieldConfig);
		
		$this->init();
	}
	
	private function init()
	{
		$options = array();
		
		$rawOptions = explode('|', $this->options);
				
		foreach ( $rawOptions as $o )
		{
			$values = explode(',', $o);
			$option['label'] = $values[0];
			$option['value'] = $values[1];
			$option['color'] = $values[2];

			$options[] = $option;
		}
		
		$this->options = $options;
	}
	
	/**
	 * Renders the field
	 */
	public function render()
	{
		return '
<div class="field">
	<label for="'. $this->name .'">'. $this->label .'</label>
	<select id="'. $this->name .'" name="'. $this->name .'">
		'. $this->getEmptyOption() .'
		'. $this->renderOptions() .'
	</select>
</div>';
	}
	
	public function renderOptions()
	{
		$str = '';
		foreach ( $this->options as $option )
		{
			$str .= '<option value="'. $option['value'] .'">'. $option['label'] .'</option>';
		}
		
		return $str;
	}
	
	private function getEmptyOption()
	{
		if ( $this->allowEmpty ) {
			return '<option value="">'. $this->emptyLabel .'</option>';
		}
		
		return '';
	}
}


