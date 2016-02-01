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
			'delete' => true,
		),
		'emptyMsg' => 'No records found'
	);
	
	/**
	 * Data array to render
	 *
	 */
	private $data = array();
	
	private $orderby = '';
	
	private $order = 'ASC';
	
	//private $page = null;

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
		$this->setData($data);
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
	
	/**
	 * Returns the table columns
	 *
	 * @return array
	 */
	private function getCols()
	{
		if ( ! isset($this->config['index']) )
		{
			return array();
		}
		
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
				
		foreach (  array_keys($this->getCols()) as $col )
		{
			// check for label
			$label = isset($this->config['fields'][$col]['label']) ? $this->config['fields'][$col]['label'] : '';
						
			$str .= sprintf('<th>%s</th>', $label);
		}
		
		$str .= sprintf('<th colspan="2">%s</th>', $this->renderCreateLink());
		
		return $str;
	}
	
	/**
	 * returns the 'create' new URI
	 *
	 * @return string
	 */
	private function renderCreateLink()
	{
		return ($this->config['rights']['create']) ? '<a href="'. url('content/create/'. $this->config['table']) .'">+ nieuw</a>' : '';
	}
	
	/**
	 * Renders the table rows 
	 *
	 * @return string
	 */
	private function renderRows()
	{
		$str = '';
		$i = 0;
		
		if ( ! $this->data )
		{
			$str .= sprintf('<tr class=""><td colspan="%d">%s</td></tr>', $this->getColCount(), $this->config['emptyMsg']);
		}
				
		// loop over data and create row
		foreach ( $this->data as $row )
		{
			$class = ($i % 2) ? 'even' : 'odd';
			$str .= sprintf('<tr class="%s">%s</tr>', $class, $this->renderCols($row));
			
			$i++;
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
		foreach ( $this->getCols() as $col => $renderer)
		{
			if ( array_key_exists($col, $row) )
			{
				$str .= sprintf('<td>%s</td>', $this->renderer($row[$col], $renderer));
			}
		}
		
		// add row actions
		$str .= sprintf('<td>%s</td><td>%s</td>', $this->getEditLink($row['id']), $this->getDeleteLink($row['id']));
		
		return $str;
	}
	
	private function renderPaging()
	{
		'<div class="table-nav bottom">
			
			<div class="bulk-actions">
			
			</div>
			
			<ul class="table-paging">
				<li>xx items</li>
				<li class="first-page"><a href="">&laquo;</a></li>
				<li class="prev-page"><a href="">&rsaquo;</a></li>
				<li>van xx</li>
				<li class="next-page"><a href="">&lsaquo;</a></li>
				<li class="last-page"><a href="">&raquo;</a></li>
			</ul>
						
		</div>';
	}
	
	/**
	 * Returns the Edit link
	 *
	 * @return string
	 */
	private function getEditLink($rowId = 0)
	{
		// add edit link if allowed
		if ( $this->canEdit() )
		{
			return sprintf('<a href="%s">edit</a>', url('content/edit/'. $this->config['table'] . '/' . $rowId));
		}
		
		return '';
	}
	
	/**
	 * Returns the delete link
	 *
	 * @return string
	 */
	private function getDeleteLink($rowId = 0)
	{
		// add delete link if allowed
		if ( $this->canDelete() ) 
		{
			return sprintf('<a href="%s">delete</a>', url('content/delete/'. $this->config['table'] . '/' . $rowId));
		}
		
		return '';
	}
	
	/**
	 * Returns the table title in plural form
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->config['title']['plural'];
	}
	
	/**
	 * Returns the table description
	 *
	 * @return string
	 */
	public function getDescription()
	{
		return $this->config['description'];
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
	
	/**
	 * Returns the table's total column count
	 *
	 * @return int
	 */
	private function getColCount()
	{
		// set # cols to total cols
		$count = count($this->getCols());
		
		// increase column count for 'actions' cols 
		$count += $this->canEdit() ? 1 : 0;		
		$count += $this->canDelete() ? 1 : 0;
		
		return $count;
	}
	
	/**
	 * Set the data array
	 *
	 * @return array
	 */
	private function setData($data = array())
	{
		// check for data, or init
		$data = $data ? $data : array();
				
		// get data
		$data = DB::query(sprintf('SELECT * FROM `%s`', $this->config['table']));
		
		return $this->data = $data;
	}
	
	
	
	
	/*---------------- renderers -----------------*/
	
	/**
	 * Renders a Column value
	 *
	 * @return string
	 */
	private function renderer($value = '', $renderer = '')
	{
		// if renderer is a string
		if ( is_string($renderer) && $renderer )
		{
			// form the function name
			$fname = explode('|', $renderer);
			$options = isset($fname[1]) ? $fname[1] : false;
					
			$renderFunction = $fname[0] . 'Renderer';
			
			// check if the function exists and return its value
			if ( method_exists($this, $renderFunction) )
			{
				return $this->{$renderFunction}($value, $options);
			}
		}
		
		// if renderer is a function (Closure)
		if ( is_callable($renderer) )
		{
			return $renderer($value);
		}
		
		return $value;
	}
	
	private function activeRenderer($value = '')
	{
		return '<span class="rndrr-active-'. ($value ? 'yes' : 'no') .'">'. ($value ? 'Ja' : 'Nee') .'</span>';
	}
	
	private function dateRenderer($value = '', $format = '%d-%m-Y')
	{
		return strftime($format, strtotime($value));
	}
	
	private function ellipsisRenderer($value = '', $limit = 50)
	{
		$str = trim(strip_tags($value));
		
		$str = ($limit && strlen($str) > $limit) ? substr($str, 0, $limit) . '...' : $str;
				
		return $str;
	}
	
	private function textRenderer($value = '')
	{
		return trim(strip_tags($value));
	}
}