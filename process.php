<?php
if(isset($_POST["submit"])){

$to = "sacchinadarsh@gmail.com";
$subject =$_POST["subject"] ;
$from="sacchinadarsh@gmail.com";
$sender=$_POST["name"];
$email=$_POST["email"];
$msg=$_POST["message"];
$headers = "From: $from";
$mailBody="Name: $sender\nEmail: $email\n\nMessage: $msg";    


if(mail($to,$subject,$mailBody,$headers)){
    echo "Email successfully sent.";
    
    
}
else{
    echo "Sorry,failed to send mail.";
}

}
?>
