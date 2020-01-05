<?php
// Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "Aucun arguments fournis";
   return false;
   }
   
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));
   
// Création et envoi du message
$to = 'cedflam@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Contact depuis le blog de : $name";
$email_body = "Vous avez reçu un message depuis le blog.\n\n"."Voici les détails:\n\nNom: $name\n\nEmail: $email_address\n\nMessage:\n$message";
$headers = "De: noreply@gmail.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Répondre à : $email_address";   
mail($to,$email_subject,$email_body,$headers);
return true;
