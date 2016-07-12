<?php 

namespace Pacman\lib\Menu;

use Pacman\lib\Config\Config;
use Pacman\lib\Uri\Uri;

class Menu
{
	/**
	 * Factory method
	 *
	 * @return Menu object
	 */
	public static function make()
	{
		return new self();
	}
	
	/**
	 * Returns array with menu structure
	 *
	 * @return array
	 */
	public function getMenu()
	{
		$menu = array();
		$modules = Config::get('modules');

		// loop over each module and get items
		foreach ( $modules as $key => $module )
		{	
			// get menu item array
			$menu[$key] = $this->getItem($module);
		}
						
		return $menu;
	}
	
	/**
	 * Returns the items for given module
	 *
	 * @return array
	 */
	private function getItem($module = array())
	{
		// add missing fields defaults
		$module = array_merge($module, [
			'table'    => '',
			'active'   => false,
			'url'      => '',
			'subitems' => []
		]);
		
		// check for tables entry
		if ( !empty($module['tables']) )
		{
			$tables = $module['tables'];
			$table  = reset($module['tables']);
			
			// load config for this table
			$config = Config::table($table);
			
			$module['table']    = $table;
			$module['active']   = in_array(Uri::segment(2), $tables);
			$module['url']      = $this->getItemUrl($table, $config->isSingleRecord());
			$module['subitems'] = $this->getMenuSubitems($tables);
		}
		
		return $module;
	}
	
	/**
	 * Returns the submenu items for given tables 
	 *
	 * @param array $tables
	 * @return array
	 */
	private function getMenuSubitems($tables = array())
	{
		$subitems = array();
		
		foreach ( $tables as $table )
		{
			// get the config
			$config = Config::table($table);
						
			// built the array
			$subitems[] = array(
				'url'    => $this->getItemUrl($table, $config->isSingleRecord()),
				'label'  => $config->getTitle(),
				'active' => Uri::segment(2) == $table
			);
		}
		
		return $subitems;		
	}
	
	/**
	 * Returns the item URL
	 *
	 * @param string $table
	 * @param bool $single_record Flag indicating if the link should go directly to the first record
	 * 
	 * @return str
	 */
	private function getItemUrl($table = '', $single_record = false)
	{
		// if flag is set, return the link to edit screen directly
		if ( $single_record )
		{
			return url('content/edit/'. $table. '/1');
		}
		
		// return url to list view
		return url('content/index/'. $table);
	}
	
	/**
	 * Renders the complete menu list items
	 *
	 * @return string
	 */
	public function render()
	{
		$str = '';
		
		foreach ($this->getMenu() as $key => $n )
		{
			// if key == '--', we render a spacer LI to separate the system tables
			// from the user generated content
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
	 * @return string
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
				<li'. (($s['active']) ? ' class="active"' : '') .'>
					<a href="'. $s['url'] .'">'. ucfirst($s['label']) .'</a>
				</li>
			</ul>';
		}
			
		return $sub;
	}	
}