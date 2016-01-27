

<?php

/*
|--------------------------------------------------------------------------
| Main CMS Configuration
|--------------------------------------------------------------------------
|
| This is the form configuration file
| This file defines the tables config in 
| the following way:
|
| <fieldname>[type]			Field type (input|text|radio|select|checkbox|editor|file|image|slug)
| <fieldname>[label]		Label next to field
| <fieldname>[placeholder]	Optional placeholder
| <fieldname>[list]			Show the column in list yes/no
|
*/

return [
		
		'name'			=> 'news_categories',
		'title' 		=> array('plural' => 'Categorieën', 'singular' => 'Categorie'),
		'description' 	=> 'Dit is een omschrijving',
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
			/*'token' => [
				'type' => 'hidden',
			],*/
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
