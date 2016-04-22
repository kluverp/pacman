<?php

class Input
{
    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    private static $instance;
    
    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }
	
	/**
	 * Returns the input variable in order of precedence (GET, POST, COOKIE)
	 *
	 * @return mixed
	 */
	public static function get($key = '', $default = false)
	{
		if ( isset($_GET[$key]) )
		{
			return self::clean($_GET[$key]);
		}
		elseif ( isset($_POST[$key]) )
		{
			return self::clean($_POST[$key]);
		}
		elseif(isset($_COOKIE[$key]))
		{
			return self::clean($_COOKIE[$key]);
		}
		
		return $default;
	}
	
	/**
	 * Returns all Request data
	 *
	 * @return array
	 */
	public static function all()
	{
		return $_REQUEST;	
	}
	
	private static function clean($value = '')
	{
		
	}

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}