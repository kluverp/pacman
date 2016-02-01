<?php

class TableConfig
{
	private $table = '';
	private $title = array('plural' => '', 'singular' => '');
	private $description = '';
	private $rights = array(
		'create' => true,
		'edit'   => true,
		'delete' => true
	);
	private $emptyMsg = '';
	
	
	public function __construct($table = '', $config = array())
	{
		$this->table = $table;
	}
	
	public function getTable()
	{
		return $this->table;
	}
	
	public function getTitle($type = 'plural')
	{
		// check for title
		if ( ! in_array($type, array('plural', 'singular')) )
		{
			trow new Exception('This is not a valid TableConfig title entry');
		}
		
		return $this->title[$type];
	}
	public function getDescription()
	{
		return $this->description;
	}
	
		/**
	 * Returns if the user may edit records
	 *
	 * @return bool
	 */
	private function canEdit()
	{
		return $this->config['rights']['edit'] === true;
	}
	
	/**
	 * Returns if the user may delete records yes/no
	 *
	 * @return bool
	 */
	private function canDelete()
	{
		return $this->config['rights']['delete'] === true;
	}
	
	public function __get($name = '')
	{
		
	}

}