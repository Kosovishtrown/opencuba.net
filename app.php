<?php

	require 'vendor/autoload.php';
	use Mailgun\Mailgun;


	$mgClient = new Mailgun('key-4npkxa6n706uqaxa58ixijv83vdmjwo7');
	$domain = "sandbox77528.mailgun.org";

	$to = $_GET['from'];
	$subject = $_GET['subject'];
	$body = $_GET['stripped-text'];
	$random_name = rand();

	if ($body == 'texto') {

		$texto = 'https://www.readability.com/api/content/v1/parser?url='.$subject.'&token=20fe51c16c041aadddf1cd3595cd84701f708c67';
		$texto_json = file_get_contents($texto); 
		$texto = json_decode($texto_json, TRUE);
		
		$result = $mgClient->sendMessage("$domain",
		  	array('from'    => 'Excited User <bob@sandbox77528.mailgun.org>',
		  	      'to'      => $to,
		  	      'subject' => 'Hello',
		  	      'text'    => 'hola',
		  		  'html'    => $texto['content'])
		  	);

	} elseif ($body == 'pdf') {
		echo "pdf";

		$pdf_command = "/usr/local/bin/wkhtmltopdf --load-error-handling ignore";
 
		$pdf_dir = "/usr/share/nginx/html/pdf/";

		$pdf_file_name = $random_name.'.pdf';

		$pdf_ex = "$pdf_command $subject " . $pdf_dir . $pdf_file_name;

		$pdf_output = shell_exec($pdf_ex); //execute the pdf converter

		$pdf_url = $pdf_dir."".$pdf_file_name; //build url for mime convertion
		
		$result = $mgClient->sendMessage("$domain",
		  	array('from'    => 'Excited User <bob@sandbox77528.mailgun.org>',
		  	      'to'      => $to,
		  	      'subject' => 'Hello',
		  	      'text'    => $pdf_url),
		  	array('attachment' => array($pdf_url)));

	} elseif ($body == 'imagen') {
		# start the image request
	}

		

	

?>