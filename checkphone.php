<?php
  #REPLACE WITH ACTUAL PHP CHECKING CODE
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  require_once('./db.php');
  require_once('./client.php');
  require_once('./tutor.php');
  require_once('./twilio-php-master/Twilio/autoload.php');
  require_once('./PHPMailer-master/PHPMailerAutoload.php');
  use Twilio\Rest\Client;
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];
    $db = new db();

    #return 0 if phone exists and return 1 if available

    if($db->checkPhone($phone) == false)
      echo '0';
    else
    {
      $sid = "ACd2b043a8d3109834a0bbf0a83533d0d9";
      $token = "12d9b3706c3c5369f1b0cf02b287eae3";
      $client = new Client($sid, $token);
      $mail = new PHPMailer;

      $phoneCode = substr(md5(microtime()),rand(0,26),5);
      $emailCode = substr(md5(microtime()),rand(0,26),5);

      $mail = new PHPMailer(); // create a new object
      $mail->IsSMTP(); // enable SMTP
      $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
      $mail->Host = "mail.actilis.org";
      $mail->Port = 587; // or 587
      $mail->IsHTML(true);
      $mail->Username = "akadon@actilis.org";
      $mail->Password = "khoakhoa98";
      $mail->SetFrom("akadon@actilis.org");
      $mail->Subject = "Test";
      $mail->AddAddress($email, "Recepient");
      $mail->Body = $emailCode;

      $client->account->messages->create(
        $phone,
        array(
          'from' => '+441683292029',
          'body' => $phoneCode
          )
        );
      if(!$mail->send()) 
      {
        $emailSentError = "Problem sending verification code";
        echo '0';
      } 
      else 
      {
        $emailSentError = "Verficiation code sent";
        echo '1';
      }
      //if ($usertype == 'client')
      //{
        

     // }
     // else if ($usertype == 'tutor')
    //  {
    //    
    //  }
    } 
  }
?>