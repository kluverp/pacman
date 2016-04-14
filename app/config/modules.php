<?php

return array(

	'home' => array(
		'label'  => 'Home',
		'icon'   => '',
		'tables' => array('home')
	),
	'news' => array(
		'label'  => 'News',
		'icon'   => '',
		'tables' => array('news_news', 'news_categories')
	),
	'contact' => array(
		'label'  => 'Contact',
		'icon'   => '',
		'tables' => array()
	),
	
	'--' => array(),
	
	'settings' => array(
		'label'  => 'Settings',
		'icon'   => '&#9881;',
		'tables' => array('cms_settings', 'cms_users', 'cms_users_roles', 'cms_languages')
	)
);
