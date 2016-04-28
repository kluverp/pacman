<?php

require_once(LIB_PATH . 'Table.php');
require_once(LIB_PATH . 'Form/Form.php');
require_once(LIB_PATH . 'Breadcrumb.php');
require_once(CONTROLLER_PATH . 'BaseController.php');

class ContentController extends BaseController
{
	/**
	 * The action URI part
	 * @var string
	 */
	private $action   = '';
	
	/**
	 * Table name URI part
	 * @var string
	 */
	private $table    = '';
	
	/**
	 * Record ID URI part
	 * @var int
	 */
	private $recordId = 0;
	
	/**
	 * The table configuration file
	 * @var array
	 */
	private $tableConfig = false;

	/**
	 * Class Constructor
	 *
	 */
	public function __construct()
	{
		// call parent
		parent::__construct();
		
		// set uri params
		$this->action   = Uri::segment(1);
		$this->table    = Uri::segment(2);
		$this->recordId = Uri::segment(3);
		
		// set table config
		$this->tableConfig = Config::table($this->table);
	}
	
	/**
	 * Index function
	 */
	public function getIndex()
	{	
		// create table
		$table = Table::make($this->tableConfig);
		
		// output the view
		return $this->output('table', array('table' => $table));
	}

	/**
	 * Create a new record
	 *
	 */
	public function getCreate()
	{
		// create the form
		$form = Form::make($this->tableConfig->getFields());
		
		// output the view
		return $this->output('form', array(
			'form'        => $form,
			'title'       => $this->tableConfig->getTitle('singular'),
			'description' => $this->tableConfig->getDescription(),
			'formAction'  => $this->getActionUrl()
		));
	}
	
	/**
	 * Handles the POST request of the create action
	 *
	 * @return redirect
	 */
	public function postCreate()
	{
		// store record
		$id = DB::insert($this->table, array('title' => 'foobar'));
		
		// redirect to edit screen
		return redirect($this->getActionUrl());
	}
	
	/**
	 * Returns the edit page for editing a record
	 *
	 * @return view
	 */
	public function getEdit()
	{
		// get the record
		if ( ! $record = DB::byId($this->table, $this->recordId) )
		{
			dd('Record not found');
		}

		// load the view
		return $this->output('form', array(
			'title'       => $this->tableConfig->getTitle('singular'),
			'description' => $this->tableConfig->getDescription(),
			'form'        => Form::make($this->tableConfig->getFields(), $record),
			'formAction'  => $this->getActionUrl(),
		));
	}
	
	/**
	 * Handles the POST action on edit forms
	 *
	 */
	public function postEdit()
	{
		// check if record exists
		if ( DB::byId($this->table, $this->recordId) )
		{
			// update record
			$result = DB::update($this->table, Input::all());
			
			//dd($result);
		}
		
		// redirect to edit screen
		return redirect($this->getActionUrl('edit'));
	}
	
	/**
	 * Deletes the current record
	 *
	 */
	public function getDelete()
	{
		// check if user is allowed to delete from this table
		if ($this->tableConfig->canDelete())
		{
			// delete the record
			DB::delete($this->table, $this->recordId);
		}
			
		// redirect to index
		return redirect('content/index/'. $this->table);
	}
	
	/**
	 * Returns the HTML title for these pages
	 *
	 * @return string
	 */
	protected function getHTMLTitle()
	{
		return $this->tableConfig->getTitle();
	}
	
	/**
	 * Returns the URL to the edit content action
	 *
	 * @return string
	 */
	private function getActionUrl($action = '')
	{
		// if not given, default to current action
		$action = $action ? $action : $this->action;
		
		return 'content/'. $action .'/'. $this->table .'/'. $this->recordId;
	}
	
	public function getBreadcrumbs()
	{
		$b = new Breadcrumb($this->tableConfig);
			
		return $b->getTrail();
	}


}
