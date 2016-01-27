<?php

/*
|--------------------------------------------------------------------------
| CMS Table Configuration
|--------------------------------------------------------------------------
|
| This is the table and form configuration file.
| This file defines the table config in 
| the following way:
|
| name          string Name of the table in database
| title         array  Singular and Plural title of table items
| description   string A textual description of the data in the table Will be printed above the table
| rights        array  An array defining the user rights on this table
| bulk_actions  bool   Defines wheter or not to show checkboxes in front of the table items that allows bulk actions to take place on the records
|
| index_columns array  Array with column names (as in database) to render 
| form_fields   array  Array defining the form fields to show 
|
| <fieldname>[type]			Field type (input|text|radio|select|checkbox|editor|file|image|slug)
| <fieldname>[label]		Label next to field
| <fieldname>[placeholder]	Optional placeholder
| <fieldname>[list]			Show the column in list yes/no
|
*/

return [
		
		'name'			=> 'news_news',									// required
		'title' 		=> array('plural' => '', 'singular' => ''),		// required
		'description' 	=> 'This is a description',						// (optional)
		'emptyMsg' => 'The message when no records are found',			// (optional)
		'rights' => [													// (optional)
			'create' 	=> true,
			'delete' 	=> true,
			'edit'   	=> true
		],
		'bulk_actions' => true,
		'index_columns' => [
			'title', 'content'
		],
		'form_fields' => [
			'title' => [
				'type' 			=> 'text',
				'label' 		=> 'Titel',
				'placeholder' 	=> 'Titel',
				
			],
			'content' => [
				'type' 			=> 'text',
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
