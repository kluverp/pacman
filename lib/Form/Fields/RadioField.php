<?php

class RadioField extends SelectField
{
	/**
	 * Renders the field
	 *
	 * @return string
	 */
	public function render()
	{
		return $this->wrap($this->renderOptions());
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

			if ( $this->value == null && $i == 0 || $this->value == $option['value']) {
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


