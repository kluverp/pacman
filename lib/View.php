<?php

	class View
	{
		/**
		 * @var Singleton The reference to *Singleton* instance of this class
		 */
		private static $instance = null;

		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @return Singleton The *Singleton* instance.
		 */
		public static function getInstance()
		{
			if( static::$instance === null )
			{
				static::$instance = new static();
			}

			return static::$instance;
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

		/**
		 * Loads a view file and returns the result as string
		 *
		 * @param string $file
		 * @param array $data
		 *
		 * @return string
		 * @throws Exception
		 */
		public static function make($file = '', $data = array())
		{
			// extract the data array
			extract($data);

			// check if the given 'view' file exists
			if( !is_file($file) )
			{
				throw new Exception('Cannot locate view "' . $file . '"');
			}

			// output the 'view'
			ob_start();

			// load the file
			include( $file );

			return ob_get_clean();
		}
	}