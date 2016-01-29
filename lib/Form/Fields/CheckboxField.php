<?php

class CheckboxField extends SelectField
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
			
			if ( $this->value == $option['value']) {
				$checked = ' checked="checked"';
			}
			else {
				$checked = '';
			}
			
			$str .= '<label for="'. $id .'"><input type="checkbox" id="'. $id .'" name="'. $this->name .'" value="'. $option['value'] .'" '. $checked .'/>'. $option['label'] .'</label>';
			$i++;
		}
		
		return $str;
	}
}

