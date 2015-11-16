<?php

class Model
{
	/**
	 * The table name
	 *
	 * @var string
	 */
	protected $table = '';
	
	/**
	 * DB instance
	 *
	 * @var obj
	 */
	private $db = false;
	
	/**
	 * Class Constructor
	 *
	 * @param string $db_instance	The database to connect to
	 */
	public function __construct($db_instance = false)
	{
		// get database object
		$this->db = DB::getInstance($db_instance);
	}

	/**
	 * The properties (database fields)
	 *
	 * @var array
	 */
	protected $properties = array();

	/**
	 * Find record by id
	 *
	 * @param int $id
	 */
	public function find($id = 0)
	{	
		$pdo = $this->db->prepare("SELECT * FROM ". $this->table ." WHERE id = ?");
		$pdo->execute(array($id));
		
		return $pdo->fetch();
	}
	
	/**
	 * Return row by id
	 */
	public function byId($id = 0)
	{
		return $this->find($id);
	}
	
	/**
	 * Insert a new row
	 *
	 */
	public function insert($data = array())
	{
		$keys = implode(', ', array_keys($data));
		$params = 
		$values = array_values($data);
		
		foreach ( $values as $value )
		{
			$query->bindParam(':'. $value, $value);
		}

		//$pdo = $this->db->prepare("INSERT INTO ". $this->table ." ($keys) VALUES ($values)");
		//$pdo = 
	}

	/**
	 * Set a property
	 *
	 * @param string $name
	 * @param null $value
	 */
	public function __set($name = '', $value = null)
	{
		$this->properties[$name] = $value;
	}

	/**
	 * Get a property
	 *
	 * @param string $name
	 * @return bool
	 */
	public function __get($name = '')
	{
		if ( isset($this->properties[$name]))
		{
			return $this->properties[$name];
		}

		return false;
	}

	/**
	 * Magic call method
	 *
	 * @param string $name
	 * @param array $arguments
	 *
	 * @return string
	 */
	public function __call($name = '', $arguments = array())
	{
		if ( $arguments )
		{
			return sprintf($arguments[0], $this->{$name});
		}
		
		return $this->{$name};
	}
}
