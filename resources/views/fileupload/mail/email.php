<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';



$current = date("Y/m/d h:i:s a");
$log = $current." -> ".json_encode($_POST)."\n";
$date = date("Y_m");
$filename = "email_requset_".$date.".txt";

if (file_exists($filename)) {
	$contents = file_get_contents($filename);
	$contents .= $log;
	$success = file_put_contents($filename, $contents);
} else {
	$myfile = fopen($filename, "w");
	fwrite($myfile, $log);
	fclose($myfile);
}

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 4;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    //$mail->Host = 'ladykeanecollege.edu.in';                // Specify main and backup SMTP servers
    $mail->Host = 'smtp.yandex.com';
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'no-reply@ladykeanecollege.edu.in';                 // SMTP username
    $mail->Password = 'noreply@lady@123#';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail->Priority = 1;                                  // 1 = High, 2 = Medium, 3 = Low
    $mail->AddCustomHeader("Importance: High");             // Not sure if Priority will also set the Importance header:

    //Recipients
    $mail->setFrom('no-reply@ladykeanecollege.edu.in', 'Ladykeane');
    $mail->addAddress(trim($_POST['Email']), trim($_POST['Name']));     // Add a recipient
    
	//$mail->addReplyTo('info@drrupamdas.com', 'Information');
    //$mail->addCC('tridip@geekworkx.com');
    //$mail->addBCC('bcc@example.com');

    //Add CC BCC
    /*
	if(isset($_POST['addcc'])){
        $mail->addCC('saanvihealthcare18@gmail.com');        // Add ccc
        $mail->addBCC('rupamdas_in@yahoo.com');
    }
    
    //Attachments
    if(isset($_POST['Attachment'])){
        $mail->addAttachment($_POST['Attachment']);         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    }
    */

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = trim($_POST['Subject']);
    $mail->Body    = trim($_POST['Content']);
    $mail->AltBody = '';
    
    if(method_exists($mail,'send')) {
        
        if($mail->send()){
            echo 'ok';
        }
    
    } else {
        
        echo "no";
        
    }
    
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>