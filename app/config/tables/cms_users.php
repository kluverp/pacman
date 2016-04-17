

<?php

return [
		
		'name'			=> 'users',
		'title' 		=> array('plural' => 'Users', 'singular' => 'User'),
		'description' 	=> 'Manage the users',
		'rights' => [
			'create' 	=> true,
			'delete' 	=> true,
			'edit'   	=> true
		],
		'emptyMsg' => 'my empty message',
		'columns' => [
			'id'   => '',
			'email'  => 'text',			
			'users_roles_id'    => 'text',
		],
		'fields' => [
			'id' => [
				'type' => 'hidden',
				'label' => 'ID'
			],
			'email' => [
				'type' 			=> 'input',
				'label' 		=> 'E-mail',
				'placeholder' 	=> 'john.doe@example.com',
				
			],
			'users_roles_id' => [
				'type' 			=> 'input',
				'label' 		=> 'User Role',
				'placeholder' 	=> ''
			],
		]
	];
