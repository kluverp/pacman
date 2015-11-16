<?php

require_once(APP_PATH . 'controllers/BaseController.php');

class DashboardController extends BaseController
{
	public function index()
	{
		$this->setHTMLTitle('Dashboard');
		$this->output('dashboard');
	}
}
