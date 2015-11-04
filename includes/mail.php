<?php
if($_POST)
{
    //set company variables
    $companyname = "Company Name";
    $companyemail = "info@companyname.co.uk";
    $subject = "Contact Request";

    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
       
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }
   
    //Sanitize input data using PHP filter_var().
    //Name
    if (isset($_POST["txtName"])) {
        $Name = filter_var($_POST["txtName"], FILTER_SANITIZE_STRING);
        } else {
        $Name = "emp";
    }

    //Email
    if (isset($_POST["txtEmail"])) {
        $Email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
        } else {
        $Email = "emp";
    }

    //Enquiry
    if (isset($_POST["txtEnquiry"])) {
        $Enquiry = filter_var($_POST["txtEnquiry"], FILTER_SANITIZE_STRING);
        } else {
        $Enquiry = "message";
    }
   
    //additional php validation
    if(strlen($Name)<4){ // If length is less than 4 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => 'Name is too short or empty'));
        die($output);
    }
    if(strlen($Email)<5){ // If length is less than 5 it will output JSON error.
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email address0'));
        die($output);
    }
    if(strlen($Enquiry)<3){ //check empty message
        $output = json_encode(array('type'=>'error', 'text' => 'Please provide more information regarding your enquiry'));
        die($output);
    }
   
    //email body
    $message_body = $Enquiry."\r\n\r\n-".$Name."\r\n<br>Email: ".$Email;

    //proceed with PHP email.
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= "From: " . $companyname . " <" . $companyemail . ">" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
   
    $send_mail = mail($companyemail, $subject, $message_body, $headers);
   
    if(!$send_mail)
    {
        //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);
    }
    else {
        //$output = json_encode(array('type'=>'message', 'text' => 'Thank you for your enquiry, we will be in touch as soon as possible.'));
        $output = json_encode(array('type'=>'message', 'text' => 'Thank you for your enquiry, we will be in touch as soon as possible.'));
        die($output);
    }
}
?>