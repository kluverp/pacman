<?php

namespace Pacman\lib\Form\Fields;

class CheckboxField extends SelectField
{
	/**
	 * Renders the field
	 */
	public function render()
	{
		return '
<div class="field">
	<label for="'. $this->getName() .'">'. $this->getLabel() .'</label>
	<div class="cbx-group">'. $this->renderOptions() .'</div>
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
			
			if ( $this->value == $option['value']) {
				$checked = ' checked="checked"';
			}
			else {
				$checked = '';
			}
			
			$str .= '<label class="cbx" for="'. $id .'"><input type="checkbox" id="'. $id .'" name="'. $this->name .'" value="'. $option['value'] .'" '. $checked .'/>'. $option['label'] .'</label>';
			$i++;
		}
		
		return $str;
	}
}


