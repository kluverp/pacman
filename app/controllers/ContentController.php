<?php

require_once(ROOT_PATH . 'lib/Table.php');
require_once(ROOT_PATH . 'lib/Form/Form.php');

class ContentController extends Controller
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
		$form = Form::make($this->tableConfig['fields']);
		
		// output the view
		return $this->output('form', array(
			'form'       => $form,
			'title'      => ucfirst($this->tableConfig['title']['singular']),
			'description' => ucfirst($this->tableConfig['description']),
			'formAction' => url(Uri::segment(0) .'/'. Uri::segment(1) .'/'. Uri::segment(2))
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
		// check if user is allowed to delete from this table
		if ($this->tableConfig->canDelete())
		{
			// delete the record
			DB::delete($this->table, $this->recordId);
		}
			
		// redirect to index
		return redirect('content/index/'. Uri::segment(2));
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


}
