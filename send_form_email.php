<?php
if(isset($_POST['email'])) {
 
    // Ändrar till min mail och meddelandets ämne
    $email_to = "xxtamsirxx@gmail.com";
    $email_subject = "Virtual Eleven";
 
    function died($error) {
        // Här skriver jag in en error kod om användaren skulle uppge fel uppgifter
        echo "Det blev fel med uppgifterna du angav. ";
        echo "Felen är.<br /><br />";
        echo $error."<br /><br />";
        echo "Var vänligen och gå tillbaka och fixa dessa fel.<br /><br />";
        die();
    }
 
 
    // Jag använder if sats om användaren inte skulle svara eller svara fel uppgifter
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['comments'])) {
        died('Det blev fel med uppgifterna du angav.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // OBLIGATORISKT
    $last_name = $_POST['last_name']; // OBLIGATORISKT
    $email_from = $_POST['email']; // OBLIGATORISKT
    $comments = $_POST['comments']; //OBLIGATORISKT
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// Skapar email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 

 
Tack för din anmälan vi hör av oss till dig inom kort!
 
<?php
 
}
?>