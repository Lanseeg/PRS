<?php
	$users = [
	    [
	        'full_name' => 'User0',
	        'email' => 'user1@exemple.com',
	        'age' => 34,
            'active' => true,
	    ],
	    [
	        'full_name' => 'User1',
	        'email' => 'user1@exemple.com',
	        'age' => 25,
            'active' => true,
	    ],
	    [
	        'full_name' => 'User2',
	        'email' => 'user2@exemple.com',
	        'age' => 43,
            'active' => false,
	    ],
];

foreach($users as $user){
    if($user['active']){
         echo $user['full_name'];
    }

    
}
?>