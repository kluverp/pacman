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
			if ( ! isset($module['tables'])) 
			{
				continue;
			}
			
			$tables = $module['tables'];
			$url = url('content/index/'. reset($tables));
			
			$menu[] = array(
				'label'    => $module['label'],
				'table'    => reset($tables),
				'active'   => in_array(Uri::segment(2), $tables),
				'url'      => $url,
				'subitems' => $this->getMenuSubitems($tables)
			);
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
		
		foreach ($this->getMenu() as $n )
		{		
			$str .= '
			<li'. (($n['active']) ? ' class="active"' : '') .'>
				<a href="'. $n['url'] .'">'. ucfirst($n['label']) .'</a>
				'. $this->renderSubmenu($n['subitems']) .'
			</li>';
		}
		
		return $str;
	}
	
	/**
	 * Renders the Submenu items
	 *
	 */
	private function renderSubmenu($submenu = array())
	{
		$sub = '';
		
		foreach ( $submenu as $s )
		{
			$sub .= '
			<ul>
				<li><a href="'. $s['url'] .'">'. ucfirst($s['label']) .'</a></li>
			</ul>';
		}
			
		return $sub;
	}
	
}