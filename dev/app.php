<?php

// The URL to get your HTML
$url = "http://www.facebook.com/";
 
// Name of your output image
$name = "example.jpg";
 
// Command to execute
$command = "wkhtmltoimage --load-error-handling ignore";
 
// Directory for the image to be saved
$image_dir = "/usr/share/nginx/html/images/";
 
// Putting together the command for `shell_exec()`
$ex = "$command $url " . $image_dir . $name;
 
// The full command is: "/usr/bin/wkhtmltoimage-i386 --load-error-handling ignore http://www.google.com/ /var/www/images/example.jpg"
// If we were to run this command via SSH, it would take a picture of google.com, and save it to /vaw/www/images/example.jpg
 
// Generate the image
// NOTE: Don't forget to `escapeshellarg()` any user input!
$output = shell_exec($ex);

?>