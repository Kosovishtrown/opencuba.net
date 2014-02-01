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

			$texto = 'https://www.readability.com/api/content/v1/parser?url='.$_POST['subject'].'&token=20fe51c16c041aadddf1cd3595cd84701f708c67';
			$texto_json = file_get_contents($texto); 
			$texto = json_decode($texto_json, TRUE);
			
			$result = $mgClient->sendMessage("$domain",
			  	array('from'    => 'Excited User <bob@sandbox77528.mailgun.org>',
			  	      'to'      => $_POST['from'],
			  	      'subject' => 'Hello',
			  	      'text'    => 'hola',
			  		  'html'    => $texto['content'])
			  	);

		}

		

	}
	

?>