<?php

class DB
{
	/**
     * Used to store and provide instances for the getInstance() method
     */ 
    private static $instances = array();
	
	/**
	 * Holds the queries
	 */
	private $queries = array();
	
	/**
	 * Class constructor creates new DB instance 
	 *
	 * @return void
	 */	
	public function __construct() { }
	
	/**
	 * Hidden magic clone method, make sure no instances of this class  
	 * can be cloned using the clone keyword
 	 */
    private function __clone() { }
	
    /**
     * Create a new instance if one doesn't exist with the key provided.
     * Once an instance has been created, or if it was already created, return it.
	 *
     * @param $key the key which the instance should be stored/retrieved
     * @return self
     */
    public static function getInstance($key = '')
	{
		// if no key given, return first record
		if ( ! $key )
		{
			return reset(self::$instances);
		}
		
        // check if an instance exists with this key already
        if( !array_key_exists($key, self::$instances))
		{
            return false;
        }

        // return the correct instance of this class
        return self::$instances[$key];
    }
	
	/**
	 * Create a new Database instance
	 *
	 * @return PDO obj
	 */
	public static function setInstance($key = '', $host = '', $schema = '', $username = '', $password = '')
	{
		try {
			$pdo = new PDO('mysql:host='. $host .';dbname='. $schema, $username, $password);
		} catch (PDOException $e) {
			exit("Error!: " . $e->getMessage() . "<br/>");
		}
		
		// store instance
		return self::$instances[$key] = $pdo;
	}
	
	/**
	 * Perform raw SQL query
	 *
	 * @return mixed
	 */
	public static function query($query = '', $instance = false)
	{
		// get PDO obj
		$db = self::getInstance($instance);
		
		// run query
		return $db->query($query);
	}
	
	/**
	 * Returns the record by ID
	 *
	 * @param string $table 		The tablename to get from
	 * @param int $id 				The record ID to get
	 *
	 * @return mixed
	 */
	public static function byId($table = '', $id = 0)
	{
		return DB::fetch('SELECT * FROM `'. $table .'` WHERE id = ?', array($id));
	}
	
	/**
	 * Perform prepared statement with given query and params
	 * You can choose either to use the ? notation or the :foo notation.
	 *
	 * @return obj
	 */
	public static function prepared($query = '', $params = array(), $instance = false)
	{
		// get the database instance
		$db = self::getInstance();
		
		// run prepared statement
		$sth = $db->prepare($query);
		
		// execute
		$result = $sth->execute($params);
				
		// return result
		return $sth;
	}
	
	public static function fetch($query = '', $params = array(), $instance = false)
	{
		if ( $result = self::prepared($query, $params) )
		{
			return $result->fetch();
		}
		
		return false;
	}
	
	/**
	 * Insert data to db
	 *
	 *
 	 */
	public static function insert($table = '', $data = array(), $instance = false)
	{
		// get db instance
		$db = self::getInstance($instance);
		
		// set keys and values
		$keys = implode(',', array_keys($data));
		$vals = implode(',', array_fill(0, count($keys), '?'));
		
		$query = 'INSERT INTO `'. $table .'` ('. $keys .') VALUES('. $vals .')';

		// prepare db statement
		$stmt = $db->prepare($query);

		// run query
		if ( !$stmt->execute(array_values($data)) )
		{
			return false;
		}
		
		// return last insert id
		return $db->lastInsertId();		
	}
	
	public static function update($table = '', $data = array(), $instance = false)
	{
		// get db instance
		$db = self::getInstance($instance);
		
		// set keys and values
		$keys = implode(',', array_keys($data));
		$vals = implode(',', array_fill(0, count($keys), '?'));
		
		$id = $data['id'];
		
		$query = 'UPDATE `'. $table .'` SET WHERE id = '. $id;

		// prepare db statement
		$stmt = $db->prepare($query);

		// execute the query
		$stmt->execute();

		return $stmt->rowCount();
	}	
	
	/**
	 * Delete a record by given id
	 *
	 * @param string $table 	  The table name to remove from
	 * @param int $id             The id of the record to remove
	 * @param string $instance    The DB instance to call if not default
	 *
	 * @return bool
	 */
	public static function delete($table = '', $id = 0, $instance = false)
	{	
		// build the SQL query
		$sql = 'DELETE FROM `?` WHERE id = ?';

		// run prepared statement
		return self::prepared($sql, array($table, $id));
	}
}