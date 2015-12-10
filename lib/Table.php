<?php

class Table
{
	/**
	 * Table config defaults
	 *
	 */
	private $config = array(
		'rights' => array(
			'create' => true,
			'edit'   => true,
			'delete' => true
		)
	);
	
	/**
	 * Data array to render
	 *
	 */
	private $data = array();

	/**
	 * Class constructor
	 *
	 * @param 
	 */
	public function __construct($config = array(), $data = array())
	{
		// set config
		$this->config = array_merge($this->config, $config);
		
		// set data
		$this->data = $data;
	}
	
	/**
	 * Create new table
	 *
	 */
	public static function make($config = array(), $data = array())
	{
		return new self($config, $data);
	}
	
	public function render()
	{	
		return '
<table class="list">
	<tr>
		'. $this->renderHeads() .'
	</tr>
	'. $this->renderRows() .'
</table>
';
	}
	
	private function getCols()
	{
		return $this->config['index'];
	}
	
	/**
	 * Renders the header columns 
	 *
	 * @return string
	 */
	private function renderHeads()
	{
		$str = '';
		
		foreach (  $this->getCols() as $col )
		{
			if ( isset($this->config['fields'][$col]['label']) )
			{
				$str .= sprintf('<th>%s</th>', $this->config['fields'][$col]['label']);
			}
		}
		
		$str .= sprintf('<th colspan="2">%s</th>', $this->renderCreateLink());
		
		return $str;
	}
	
	/**
	 *
	 *
	 */
	private function renderCreateLink()
	{
		return ($this->config['rights']['create']) ? '<a href="'. url('table/create/'. $this->config['name']) .'">+ nieuw</a>' : '';
	}
	
	/**
	 * Renders the table rows 
	 *
	 * @return string
	 */
	private function renderRows()
	{
		$str = '';
				
		foreach ( $this->data as $row )
		{
			$str .= sprintf('<tr>%s</tr>', $this->renderCols($row));
		}
				
		return $str;
	}
	
	/**
	 * Renders a table row
	 *
	 * @return string
	 */
	private function renderCols($row)
	{
		$str = '';
		
		// cell contents
		foreach ( $this->getCols() as $col )
		{
			if ( array_key_exists($col, $row) )
			{
				$str .= sprintf('<td>%s</td>', $row[$col]);
			}
		}
		
		// add row actions
		$str .= sprintf('<td>%s</td><td>%s</td>', $this->getEditLink($row['id']), $this->getDeleteLink($row['id']));
		
		return $str;
	}
	
	private function getEditLink($rowId = 0)
	{
		// add edit link if allowed
		if ( $this->config['rights']['edit'] === true)
		{
			return sprintf('<a href="%s">edit</a>', url('table/edit/'. $this->config['name'] . '/' . $rowId));
		}
		
		return '';
	}
	
	private function getDeleteLink($rowId = 0)
	{
		// add delete link if allowed
		if ( $this->config['rights']['delete'] === true) 
		{
			return sprintf('<a href="%s">delete</a>', url('table/delete/'. $this->config['name'] . '/' . $rowId));
		}
		
		return '';
	}
	
	public function getTitle()
	{
		return $this->config['title'];
	}
	
	public function getDescription()
	{
		return $this->config['description'];
	}
}