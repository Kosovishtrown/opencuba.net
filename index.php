<?php

require 'vendor/autoload.php';
require 'vendor/autoload.php';
use Mailgun\Mailgun;

	$app = new \Slim\Slim();
	
    //Routes
	$app->get('/', 'home');
	$app->post('/convert', 'convert');

	$app->run();
	
	
	function home() {
		echo "You should not be here";

		

	}

	function convert() {
		
		# Instantiate the client.
		$mgClient = new Mailgun('key-4npkxa6n706uqaxa58ixijv83vdmjwo7');
		$domain = "sandbox77528.mailgun.org";

		# Make the call to the client.
		$result = $mgClient->sendMessage("$domain",
		  	array('from'    => 'Excited User <bob@sandbox77528.mailgun.org>',
		  	      'to'      => $_POST['from'],
		  	      'subject' => 'Hello',
		  	      'text'    => 'Testing some Mailgun awesomeness!')
		  	);

	}
	

?>