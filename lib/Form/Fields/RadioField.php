<?php

class RadioField extends SelectField
{
	/**
	 * Renders the field
	 */
	public function render()
	{
		return '
<div class="field">
	<label for="'. $this->getName() .'">'. $this->getLabel() .'</label>
	'. $this->renderOptions() .'
</div>';
	}
	
	/**
	 * Renders the options
	 *
	 */
	public function renderOptions()
	{
		$str = '';
		$i   = 0;
				
		foreach ( $this->options as $option )
		{
			$id = $this->name . '_' . $i;
			
			if ( !$this->value && $i == 0 || $this->value == $option['value']) {
				$checked = ' checked="checked"';
			}
			else {
				$checked = '';
			}
			
			$str .= '<input type="radio" id="'. $id .'" name="'. $this->name .'" value="'. $option['value'] .'" '. $checked .'/><label for="'. $id .'">'. $option['label'] .'</label>';
			$i++;
		}
		
		return $str;
	}
}


