<?php

require_once(ROOT_PATH . 'lib/Form/Field.php');
require_once(ROOT_PATH . 'lib/Form/SelectField.php');

class RadioField extends SelectField
{
	/**
	 * Renders the field
	 */
	public function render()
	{
		return '
<div class="field">
	<label for="'. $this->name .'">'. $this->label .'</label>
	'. $this->renderOptions() .'
</div>';
	}
	
	public function renderOptions()
	{
		$str = '';
		$i = 0;
		foreach ( $this->options as $option )
		{
			$id = $this->name . '_' . $i;
			
			if ( !$this->value && $i == 0 || $this->value == $option['value']) {
				$checked = ' checked="checked"';
			}
			else {
				$checked = '';
			}
			
			$str .= '<label for="'. $id .'">'. $option['label'] .'</label><input type="radio" id="'. $id .'" name="'. $this->name .'" value="'. $option['value'] .'" '. $checked .'/>';
			$i++;
		}
		
		return $str;
	}
}


