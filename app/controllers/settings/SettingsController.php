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
						
		// create the form
		$form = Form::make($this->tableConfig->getFields(), $record);

		// load the view
		return $this->output('form', array(
			'title'       => $this->tableConfig->getTitle('singular'),
			'description' => $this->tableConfig->getDescription(),
			'form'        => $form,
			'formAction'  => url(array($this->action, $this->table, $record['id'])),
		));
		
	}
	
	
	public function postEdit()
	{
		
	}
	
	/**
	 * Returns the HTML title for these pages
	 *
	 * @return string
	 */
	protected function getHTMLTitle()
	{
		
	}


}
