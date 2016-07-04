<?php

	class View extends Singleton
	{
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
			// check if the given 'view' file exists
			if( !is_file($file) )
			{
				throw new Exception('File not found "' . $file . '"');
			}
			
			// extract the data array
			extract($data);

			// output the 'view'
			ob_start();

			// load the file
			include( $file );

			return ob_get_clean();
		}
	}
