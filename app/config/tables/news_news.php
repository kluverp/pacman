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
| Renderers:
| bool (boolean). You can customize colors through the use of CSS
| date Displays a date in the given strftime() format. Defaults to "%d-%m-Y".
| text This will strip any HTML of your text field.
| ellipsis Show a piece of text and cut off after x chars. Defaults to 50 chars. Most uses for previewing longer pieces of text. Strips off any HTML present.
| function() You can pass in a closure (function(){}) as renderer. This function receives a $value parameter with the column value. You can use this for your custom column renderer.
*/

return [
		'title' 		=> array('plural' => 'News', 'singular' => 'News'),
		'description' 	=> 'This is a description',		
		'rights' => [
			'create' 	=> true,
			'delete' 	=> true,
			'edit'   	=> true
		],
		'bulk_actions' => true,
		'emptyMsg' => 'my empty message',
		'columns' => [
			'active'  => 'bool',
			'title'   => '',
			'date'    => 'date|%d-%m-%Y',
			'content' => 'ellipsis|10'
			/*'content' => function($value)
			{
				return $value . ' FOOBAR';
			}*/
		],
		'fields' => [
			'active' => [
				'type'          => 'text',
				'label'         => 'Actief'
			],
			'title' => [
				'type' 			=> 'text',
				'label' 		=> 'Titel',
				'placeholder' 	=> 'Titel',
				
			],
			'content' => [
				'type' 			=> 'textarea',
				'label' 		=> 'Inhoud',
				'placeholder' 	=> 'Inhoud',
				'required'      => true
			],
			'token' => [
				'type'          => 'hidden',
				'label'         => 'hidden'
			],
			'status' => [
				'type'          => 'radio',
				'label'         => 'Status',
				'options'       => "Ja,1,ffffff|Nee,0,ff00ee" // if left out, source comes from DB table
			],
			'fruit' => [
				'type'          => 'select',
				'label'         => 'Welk fruit?',
				'options'       => "Bananen,1,yellow|Peren,2,green|Appels,3,red"
			],
			'cars' => [
				'type'          => 'select',
				'label'         => 'Welke auto?',
				'options'       => "Ford,1,yellow|Mazda,2,green|Renault,3,red",
				'allowEmpty'    => true,
				'emptyLabel'    => 'Maak een keuze:'
			],
			'events' => [
				'type'          => 'checkbox',
				'label'         => 'Wat gaan we doen?',
				'options'       => "Ford,1,yellow|Mazda,2,green|Renault,3,red"
			]
		]
	];
