

<?php

return [		
		'name'			=> 'settings',
		'title' 		=> array('plural' => 'Settings', 'singular' => 'Settings'),
		'description' 	=> 'Modify the sitewide settings here',
		'rights' => [
			'create' 	=> false,
			'delete' 	=> false,
			'edit'   	=> true
		],
		'single_record' => true,
		'emptyMsg' => 'test',
		'columns' => [
			'id'  => 'text'
		],
		'fields' => [
			'id' => [
				'type' 			=> 'hidden',
				'label' 		=> 'ID'				
			],
			'maintenance_mode' => [
				'type' 			=> 'radio',
				'label' 		=> 'Maintenance mode',
				'options'       => 'Yes,1,ffffff|No,0,ff00ee'
			],
			'app_title' => [
				'type' => 'text',
				'label' => 'App title'
			],
			'meta_keywords' => [
				'type' => 'text',
				'label' => 'Meta Keywords'
			],
			'meta_description' => [
				'type' => 'textarea',
				'label' => 'Meta Description'
			],
			'ga_tracking_code' => [
				'type' => 'textarea',
				'label' => 'GA Tracking code'
			],
			'form_default_sender' => [
				'type' => 'text',
				'label' => 'Form default sender'
			],
			'form_default_name' => [
				'type' => 'text',
				'label' => 'Form default name'
			],
			'h1' => [
				'type' => 'heading',
				'label' => 'Address &amp; Location'
			],
			'company' => [
				'type' => 'text',
				'label' => 'Company'
			],
			'address' => [
				'type' => 'text',
				'label' => 'Address'
			],
			'postal_code' => [
				'type' => 'text',
				'label' => 'Postal code'
			],
			'city' => [
				'type' => 'text',
				'label' => 'City'
			],
			'phone' => [
				'type' => 'text',
				'label' => 'Phone'
			],
			'phone' => [
				'type' => 'text',
				'label' => 'E-mail'
			],
			'fax' => [
				'type' => 'text',
				'label' => 'Fax.'
			],
			'latitude' => [
				'type' => 'text',
				'label' => 'Latitude'
			],
			'longitude' => [
				'type' => 'text',
				'label' => 'Longitude'
			],
			'h2' => [
				'type' => 'heading',
				'label' => 'Social Media'
			],
			'facebook_uri' => [
				'type' => 'text',
				'label' => 'Facebook URL'
			],
			'twitter_uri' => [
				'type' => 'text',
				'label' => 'Twitter URL'
			],
			'linkedin_uri' => [
				'type' => 'text',
				'label' => 'LinkedIN URL'
			]
		]
	];
