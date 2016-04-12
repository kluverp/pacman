

<?php

return [
		
		'name'			=> 'settings',
		'title' 		=> array('plural' => 'Users', 'singular' => 'User'),
		'description' 	=> 'Manage the users',
		'rights' => [
			'create' 	=> true,
			'delete' 	=> true,
			'edit'   	=> true
		],			
		'index' => [
			'title', 'content'
		],
		'fields' => [
			'title' => [
				'type' 			=> 'input',
				'label' 		=> 'Titel',
				'placeholder' 	=> 'Titel',
				
			],
			'content' => [
				'type' 			=> 'input',
				'label' 		=> 'Inhoud',
				'placeholder' 	=> 'Inhoud'
			],
			'token' => [
				'type' => 'hidden',
			],
			'status' => [
				'type' => 'radio',
				'label' => 'Status',
				'options' => "Ja,1,ffffff|Nee,0,ff00ee" // if left out, source comes from DB table
			],
			'fruit' => [
				'type' => 'select',
				'label' => 'Welk fruit?',
				'options' => "Bananen,1,yellow|Peren,2,green|Appels,3,red"
			],
			'cars' => [
				'type' => 'select',
				'label' => 'Welke auto?',
				'options' => "Ford,1,yellow|Mazda,2,green|Renault,3,red",
				'allowEmpty' => true
			],
			'events' => [
				'type' => 'checkbox',
				'label' => 'Wat gaan we doen?',
				'options' => "Ford,1,yellow|Mazda,2,green|Renault,3,red"
			]
		]
	];
