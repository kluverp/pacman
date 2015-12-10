<?php

require_once(APP_PATH . 'controllers/BaseController.php');

/**
 * Dashboard page
 *
 * @class
 */
class DashboardController extends BaseController
{
	/**
	 * Loads the Dashboard page
	 *
	 * @return view
	 */
	public function getIndex()
	{
		// set page title
		$this->setHTMLTitle('Dashboard');
		
		// load the view
		return $this->output('dashboard');
	}
}
