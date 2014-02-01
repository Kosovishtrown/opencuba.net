<?php

	require 'vendor/autoload.php';
	use Mailgun\Mailgun;


	$mgClient = new Mailgun('key-4npkxa6n706uqaxa58ixijv83vdmjwo7');
	$domain = "opencuba.net";

	$to = $_GET['from'];
	$subject = $_GET['subject'];
	$body = $_GET['stripped-text'];
	$random_name = rand();

	if ($body == 'texto') {

		$texto = 'https://www.readability.com/api/content/v1/parser?url='.$subject.'&token=20fe51c16c041aadddf1cd3595cd84701f708c67';
		$texto_json = file_get_contents($texto); 
		$texto = json_decode($texto_json, TRUE);
		
		$result = $mgClient->sendMessage("$domain",
		  	array('from'    => 'Open Cuba <responde@opencuba.net>',
		  	      'to'      => $to,
		  	      'subject' => 'Hello',
		  	      'text'    => $subject,
		  		  'html'    => $texto['content'])
		  	);

	} elseif ($body == 'pdf') {

		$pdf_command = "/usr/local/bin/wkhtmltopdf --load-error-handling ignore -l";
 
		$pdf_dir = "/usr/share/nginx/html/pdf/";

		$pdf_file_name = $random_name.'.pdf';

		$pdf_ex = "$pdf_command $subject " . $pdf_dir . $pdf_file_name;

		$pdf_output = shell_exec($pdf_ex); //execute the pdf converter

		$pdf_url = $pdf_dir."".$pdf_file_name; //build url for mime convertion
		
		$result = $mgClient->sendMessage("$domain",
		  	array('from'    => 'Open Cuba <responde@opencuba.net>',
		  	      'to'      => $to,
		  	      'subject' => 'Hello',
		  	      'text'    => $subject),
		  	array('attachment' => array($pdf_url)));

	} elseif ($body == 'imagen') {
		# start the image request

		$image_command = "/usr/local/bin/wkhtmltoimage --load-error-handling ignore --quality 50";
 
		$image_dir = "/usr/share/nginx/html/images/";

		$image_file_name = $random_name.'.jpg';

		$image_ex = "$image_command $subject " . $image_dir . $image_file_name;

		$image_output = shell_exec($image_ex); //execute the pdf converter

		$image_url = $image_dir."".$image_file_name; //build url for mime convertion
		
		$result = $mgClient->sendMessage("$domain",
		  	array('from'    => 'Open Cuba <responde@opencuba.net>',
		  	      'to'      => $to,
		  	      'subject' => 'Hello',
		  	      'text'    => $subject),
		  	array('attachment' => array($image_url)));
	}

		

	

?>