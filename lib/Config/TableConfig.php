<?php

namespace Pacman\lib\Config;

class TableConfig
{
	/**
	 * The database table name
	 * @var string
	 */
	private $table         = '';
	
	/**
	 * Screen title (plural for overview, singular for record)
	 * @var string
	 */
	private $title         = array('plural' => '', 'singular' => '');
	
	/**
	 * A page description, telling the user what he can do with the current record(s)
	 * @var string
	 */
	private $description   = '';
	
	/**
	 * The user rights on this table
	 * @var array
	 */
	private $rights        = array(
		'create' => true,
		'edit'   => true,
		'delete' => true
	);
	
	/**
	 * Flag indicating the record is a 'single record'. Meaning the list-view can be
	 * skipped and the user can go directly to edit screen.
	 */
	private $single_record = false;
	
	/**
	 * The message to show the user if no records are found.
	 * @var string
	 */
	private $emptyMsg      = 'No records found';
	
	/**
	 * The colums used in table 'list' views
	 * @var array
	 */
	private $columns       = array();
	
	/**
	 * The Form field config. This config defines the form layout on 'edit' screens
	 * @var array
	 */
	private $fields        = array();
	
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
	
	/**
	 * Returns the description field
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * Returns the empty message field
	 *
	 * @return string
	 */
	public function getEmptyMsg()
	{
		return $this->emptyMsg;
	}
	
	/**
	 * Returns the single_record flag
	 *
	 * @return string
	 */
	public function isSingleRecord()
	{
		return $this->single_record;
	}
	
	/**
	 * Returns the table column definitions
	 *
	 * @return string
	 */
	public function getColumns()
	{
		return $this->columns;
	}
	
	/**
	 * Returns the column definition
	 *
	 * @return string
	 */
	public function getColumn($column = '')
	{
		if ( isset($this->columns[$column]) )
		{
			return $this->columns[$column];
		}
		
		return false;
	}
	
	/**
	 * Returns the form field definitions
	 *
	 * @return string
	 */
	
	public function getFields()
	{
		return $this->fields;
	}
	
	/**
	 * Returns a single form field definition
	 *
	 * @return string
	 */
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
	
	/**
	 * Returns true if the user is allowed to create new records
	 *
	 * @return string
	 */
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
}