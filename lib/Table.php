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
	
	
	
	
	
	
	
	
	
	
	
	    /** ************************************************************************
     * Recommended. This method is called when the parent class can't find a method
     * specifically build for a given column. Generally, it's recommended to include
     * one method for each column you want to render, keeping your package class
     * neat and organized. For example, if the class needs to process a column
     * named 'title', it would first see if a method named $this->column_title() 
     * exists - if it does, that method will be used. If it doesn't, this one will
     * be used. Generally, you should try to use custom column methods as much as 
     * possible. 
     * 
     * Since we have defined a column_title() method later on, this method doesn't
     * need to concern itself with any column with a name of 'title'. Instead, it
     * needs to handle everything else.
     * 
     * For more detailed insight into how columns are handled, take a look at 
     * WP_List_Table::single_row_columns()
     * 
     * @param array $item A singular item (one full row's worth of data)
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed inside the column <td>
     **************************************************************************/
    function column_default($item, $column_name){
        switch($column_name){
            case 'rating':
            case 'director':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }


    /** ************************************************************************
     * Recommended. This is a custom column method and is responsible for what
     * is rendered in any column with a name/slug of 'title'. Every time the class
     * needs to render a column, it first looks for a method named 
     * column_{$column_title} - if it exists, that method is run. If it doesn't
     * exist, column_default() is called instead.
     * 
     * This example also illustrates how to implement rollover actions. Actions
     * should be an associative array formatted as 'slug'=>'link html' - and you
     * will need to generate the URLs yourself. You could even ensure the links
     * 
     * 
     * @see WP_List_Table::::single_row_columns()
     * @param array $item A singular item (one full row's worth of data)
     * @return string Text to be placed inside the column <td> (movie title only)
     **************************************************************************/
    function column_title($item){
        
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['title'],
            /*$2%s*/ $item['ID'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }
}