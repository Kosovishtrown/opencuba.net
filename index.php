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

		$to = $_POST['from'];
		$subject = $_POST['stripped-text'];
		$body = $_POST['content'];

		$random_name = rand(5, 15);



		if ($_POST['stripped-text'] == 'texto') {

			$pages = 'https://www.readability.com/api/content/v1/parser?url='.$subject.'&token=20fe51c16c041aadddf1cd3595cd84701f708c67';
			$pages_json = file_get_contents($pages); 
			$pages = json_decode($pages_json, TRUE);
			
			$result = $mgClient->sendMessage("$domain",
			  	array('from'    => 'Excited User <bob@sandbox77528.mailgun.org>',
			  	      'to'      => $to,
			  	      'subject' => 'Hello',
			  	      'text'    => 'hola',
			  		  'html'    => $body)
			  	);

		} elseif ($subject == 'imagen') {
			
			# code...
		} elseif ($subject == 'pdf') { //pdf has been asked
			
			$pdf_command = "wkhtmltopdf --load-error-handling ignore";
 
			$pdf_dir = "/usr/share/nginx/html/pdf/";

			$pdf_ex = "$pdf_command $subject " . $pdf_dir . $random_name.'.pdf';

			$pdf_output = shell_exec($pdf_ex);

		} else {
			// no real request was made so just return text data

		}

		

	}
	

?>