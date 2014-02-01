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
		
		$mgClient = new Mailgun('key-4npkxa6n706uqaxa58ixijv83vdmjwo7');
		$domain = "sandbox77528.mailgun.org";


		if ($_POST['stripped-text'] == 'texto') {

			$pages = 'https://www.readability.com/api/content/v1/parser?url=http://blog.readability.com/2011/02/step-up-be-heard-readability-ideas/&token=20fe51c16c041aadddf1cd3595cd84701f708c67';
			$pages_json = file_get_contents($pages); 
			$pages = json_decode($pages_json, TRUE);
			
			$result = $mgClient->sendMessage("$domain",
			  	array('from'    => 'Excited User <bob@sandbox77528.mailgun.org>',
			  	      'to'      => $_POST['from'],
			  	      'subject' => 'Hello',
			  	      'text'    => 'hola',
			  		  'html'    => $pages['content'])
			  	);

		}

		

	}
	

?>