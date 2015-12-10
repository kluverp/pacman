<?php

require_once(ROOT_PATH . 'lib/Table.php');
require_once(ROOT_PATH . 'lib/Form/Form.php');

class TableController extends Controller
{
	/**
	 * The uri parts
	 */
	private $action = '';
	private $table = '';
	private $recordId = 0;
	
	/**
	 * The table configuration file
	 */
	private $tableConfig = false;

	/**
	 * Class Constructor
	 *
	 */
	public function __construct()
	{
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
		// get data
		$data = DB::query('SELECT * FROM news_news');
				
		// create table
		$table = Table::make($tableConfig, $data);
		
		return $this->output('table', array('table' => $table));
	}

	/**
	 * Create a new record
	 *
	 */
	public function getCreate()
	{		
		// create the form
		$form = Form::make($tableConfig['fields']);
		
		return $this->output('form', array(
			'form'       => $form,
			'table'      => $tableConfig,
			'formAction' => url(Uri::segment(0) .'/'. Uri::segment(1) .'/'. Uri::segment(2)),
			'HTMLTitle' => 'Edit'
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
		$id = DB::insert(Uri::segment(2), array('title' => 'foobar'));
		
		// redirect to edit screen
		return redirect('table/edit/'. Uri::segment(2) .'/'. $id);
	}
	
	/**
	 * Returns the edit page for editing a record
	 *
	 * @return view
	 */
	public function getEdit()
	{
		// get the record
		if ( ! $record = DB::fetch('SELECT * FROM `'. $this->table .'` WHERE id = ?', array($this->recordId)) )
		{
			dd('Record not found');
		}
						
		// create the form
		$form = Form::make($this->tableConfig['fields'], $record);
						
		return $this->output('form', array(
			'form'       => $form,
			'table'      => $this->tableConfig,
			'formAction' => url(array($this->action, $this->table, $record['id'])),
		));
		
	}
	
	
	public function postEdit()
	{
		
	}
	
	public function getDelete()
	{
		dd('go Delete some');
	}
	
	/**
	 * Returns the HTML title for these pages
	 *
	 * @return mixed
	 */
	protected function getHTMLTitle()
	{
		if (isset($this->tableConfig['title']) )
		{
			return $this->tableConfig['title'];
		}
		
		return false;
	}


}
