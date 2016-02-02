<?php

class TableConfig
{
	private $table        = '';
	private $title        = array('plural' => '', 'singular' => '');
	private $description  = '';
	private $rights       = array(
		'create' => true,
		'edit'   => true,
		'delete' => true
	);
	private $emptyMsg     = 'No records found';
	private $columns      = array();
	private $fields       = array();
	
	/**
	 * Class Constructor
	 *
	 * Set's the table name and the config values
	 */
	public function __construct($table = '', $config = array())
	{
		// set table
		$this->table = $table;
		
		// set fields
		foreach ( $config as $key => $value )
		{
			if ( isset($this->$key) )
			{
				$this->$key = $value;
			}
		}
	}
	
	/**
	 * Returns the table name e.g: 'news_news'
	 *
	 * @return string
	 */
	public function getTable()
	{
		return $this->table;
	}
	
	/**
	 * Returns the title
	 *
	 * @return string
	 */
	public function getTitle($type = 'plural')
	{
		// check for title
		if ( ! in_array($type, array('plural', 'singular')) )
		{
			throw new Exception('This is not a valid TableConfig title entry');
		}
		
		return $this->title[$type];
	}
	
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function getEmptyMsg()
	{
		return $this->emptyMsg;
	}
	
	public function getColumns()
	{
		return $this->columns;
	}
	
	public function getColumn($column = '')
	{
		if ( isset($this->columns[$column]) )
		{
			return $this->columns[$column];
		}
		
		return false;
	}
	
	public function getFields()
	{
		return $this->fields;
	}
	
	public function getField($fieldname = '', $attribute = false)
	{
		if ( isset($this->fields[$fieldname] ) )
		{
			if ( $attribute && isset($this->fields[$fieldname][$attribute]) )
			{
				return $this->fields[$fieldname][$attribute];
			}
			
			return $this->fields[$fieldname];
		}
		
		return false;
	}
	
	public function canCreate()
	{
		return $this->rights['create'] === true;
	}
	
	/**
	 * Returns if the user may edit records
	 *
	 * @return bool
	 */
	public function canEdit()
	{
		return $this->rights['edit'] === true;
	}
	
	/**
	 * Returns if the user may delete records yes/no
	 *
	 * @return bool
	 */
	public function canDelete()
	{
		return $this->rights['delete'] === true;
	}
	
	/**
	 * Returns the table's total column count
	 *
	 * @return int
	 */
	public function getColCount()
	{
		// set # cols to total cols
		$count = count($this->getColumns());
		
		// increase column count for 'actions' cols 
		$count += $this->canEdit() ? 1 : 0;		
		$count += $this->canDelete() ? 1 : 0;
		
		return $count;
	}	
	
	public function __get($name = '')
	{
		
	}

}