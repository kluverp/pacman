<?php 

class Menu {

	public function __construct($config = array())
	{
		
	}

	public static function make()
	{
		return new self();
	}
	
	public function getMenu()
	{
		$menu = array();
		$modules = Config::get('modules');
				
		foreach ( $modules as $key => $module )
		{	
			// get menu item array
			$menu[$key] = $this->getItem($module);
		}
						
		return $menu;
	}
	
	private function getMenuSubitems($tables)
	{
		$subitems = array();
		
		foreach ( $tables as $table )
		{
			$tableConfig = Config::table($table);
			
			$subitems[] = array(
				'url'   => url('content/index/' . $table),
				'label' => $tableConfig->getTitle()
			);
		}
		
		return $subitems;		
	}
	
	public function render()
	{
		$str = '';
		
		foreach ($this->getMenu() as $key => $n )
		{
			if ( $key === '--' )
			{
				$str .= '
				<li class="spacer">'. (is_string($n) ? $n : '') .'</li>';
			}
			else
			{
				$str .= '
				<li'. (($n['active']) ? ' class="active"' : '') .'>
					<a href="'. $n['url'] .'">'. (isset($n['icon']) ? $n['icon'] . ' ' : ''). ucfirst($n['label']) .'</a>
					'. $this->renderSubmenu($n['subitems']) .'
				</li>';
			}
		}
		
		return $str;
	}
	
	/**
	 * Renders the Submenu items
	 *
	 */
	private function renderSubmenu($subitems = array())
	{
		$sub = '';
		
		// check if subitems is an array
		if ( ! is_array($subitems) )
		{
			return $sub;
		}
		
		// render each subitem
		foreach ( $subitems as $s )
		{		
			$sub .= '
			<ul>
				<li><a href="'. $s['url'] .'">'. ucfirst($s['label']) .'</a></li>
			</ul>';
		}
			
		return $sub;
	}
	
	/**
	 * Returns the item URL
	 *
	 * @param string $str
	 * @return str
	 */
	private function getItemUrl($str = '')
	{
		return url('content/index/'. $str);
	}
	
	private function getItem($module = array())
	{
		// check for tables entry
		if ( isset($module['tables']) )
		{
			$tables = $module['tables'];
			$table = reset($module['tables']);
			
			$module['table']    = $table;
			$module['active']   = in_array(Uri::segment(2), $tables);
			$module['url']      = $this->getItemUrl($table);
			$module['subitems'] = $this->getMenuSubitems($tables);
		}
		
		return $module;
	}
	
}