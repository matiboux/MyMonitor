<?php
include('includes/Class.SMTP.php');
include('config.php');
$error = false;
if ($error == false)
{
  date_default_timezone_set('Europe/Paris');

require 'includes/mail/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->IsSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
function trim_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

$mail->SMTPDebug  = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host       = $hote;
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port       = 25;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = false;
//Whether to use SMTP authentication
$mail->SMTPAuth   = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username   = $mailexp;
//Password to use for SMTP authentication
$mail->Password   = $motdepassem;
//Set who the message is to be sent from
$mail->SetFrom(trim_input($mailexp), trim_input($mailexp));
//Set an alternative reply-to address
$mail->AddReplyTo(trim_input($mailexp),trim_input($mailexp));
//Set who the message is to be sent to
$mail->AddAddress($donnees['mail']);
//Set the subject line
$mail->Subject = 'Votre site est hors ligne !';
//Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
$mail->MsgHTML(trim_input('Bonjour,

Un de vos serveurs est hors ligne.

Cordialement, MyMonitor'));
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->AddAttachment('images/phpmailer_mini.gif');

//Send the message, check for errors
if(!$mail->Send()) {
echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
$mail_result = true;
}




    if ($mail_result == true)
    {
        echo 'success';
    }
    else
    {
        echo 'unsuccess';
    }
}
else
{
    echo 'error';
}




// ce que je viens de dev commence en dessous
$sms='http://hexicans.eu/api/index.php?tel=0'.$row['phone'].'&key='.$row['apikey'].'&msg='.urlencode('ALERTE MyMonitor - Un de vos serveurs semble etre hors ligne !').'';

// Cr�ation d'une nouvelle ressource cURL
$ch = curl_init();

// Configuration de l'URL et d'autres options
curl_setopt($ch, CURLOPT_URL, $sms);
curl_setopt($ch, CURLOPT_HEADER, 0);

// R�cup�ration de l'URL et affichage sur le naviguateur
curl_exec($ch);

// Fermeture de la session cURL
curl_close($ch);
?>
