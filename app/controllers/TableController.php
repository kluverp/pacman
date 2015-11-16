<?php

require_once(ROOT_PATH . 'lib/Table.php');
require_once(ROOT_PATH . 'lib/Form/Form.php');

class TableController extends Controller
{
	private $action = '';
	private $table = '';
	private $recordId = 0;

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
	}
	
	/**
	 * Index function
	 */
	public function index()
	{	
		// if table not found
		if ( ! $table = Uri::segment(2) ) {
			return $this->show404();
		}

		// get data
		$data = DB::query('SELECT * FROM news_news');
		$tableConfig = Config::table($table);
				
		// create table
		$table = Table::make($tableConfig, $data);
		
		$this->setHTMLTitle($tableConfig['title']);
		
		return $this->output('table', array('table' => $table));
	}

	/**
	 * Create a new record
	 *
	 */
	public function create()
	{
		// get table config
		$tableConfig = Config::table(Uri::segment(2));
				
		// create the form
		$form = Form::make($tableConfig['fields']);
		
		return $this->output('form', array(
			'form'       => $form,
			'table'      => $tableConfig,
			'formAction' => url(Uri::segment(0) .'/'. Uri::segment(1) .'/'. Uri::segment(2)),
			'HTMLTitle' => 'Edit'
		));
	}
	
	public function postCreate()
	{
		// store record
		$id = DB::insert(Uri::segment(2), array('title' => 'foobar'));
		
		// redirect to edit screen
		return redirect('table/edit/'. Uri::segment(2) .'/'. $id);
	}
	
	public function edit()
	{
		$tableName = Uri::segment(2);
		$recordId  = Uri::segment(3);
		
		// get table config
		if ( ! $tableConfig = Config::table($tableName) )
		{
			dd('Table not found');
		}
		
		if ( ! $record = DB::fetch('SELECT * FROM `'. $tableName .'` WHERE id = ?', array($recordId)) )
		{
			dd('Record not found');
		}
						
		// create the form
		$form = Form::make($tableConfig['fields'], $record);
		
		return $this->output('form', array(
			'form'       => $form,
			'table'      => $tableConfig,
			'formAction' => url(Uri::segment(0) .'/'. Uri::segment(1) .'/'. $tableName .'/'. $recordId),
			'HTMLTitle' => 'Edit'
		));
		
	}
	
	public function postEdit()
	{
		
	}
	
	public function delete()
	{
		dd('go Delete some');
	}


}
