<?php

//set the header type - required for json response
header('Content-Type: application/json');

if($_POST)
{
    //set company variables
    $companyname = "Cash4UNow";
    $companyemail = "adrian@novacontracting.co.uk";
    $subject = "Contact Request";

    parse_str($_REQUEST['param'], $posted);
    $response_array = array(
        "name" => $posted['txtName'],
        "email" => $posted['txtEmail'],
        "tel" => $posted['txtTel'],
        "enquiry" => $posted['txtEnquiry']
    );

    //send mail
    try {
        $name = ($response_array["name"]);
        $email = ($response_array["email"]);
        $tel = ($response_array["tel"]);
        $enquiry = ($response_array["enquiry"]);
        

        //email body
        $message_body = $enquiry."\r\n\r\n-".$name."\r\n<br>Email: ".$email;

        //proceed with PHP email.
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers .= "From: " . $companyname . " <" . $companyemail . ">" . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
       
        $send_mail = mail($companyemail, $subject, $message_body, $headers);
       
        if(!$send_mail)
        {
            //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
            $response_array['message'] = "There was a problem sending your contact request - please try again.";
            $response_array["status"] = "error";
            //die($response_array);
        }
        else {
            $response_array['message'] = "Thank you for your enquiry, we will be in touch as soon as possible.";
            $response_array["status"] = "success";
            //die($response_array['message']);
        }
    }
    catch(Exception $e) {
        $response_array['message'] = "There was a problem sending your contact request - please try again.";
        $response_array["status"] = "error";
    }

    //echo array back to the form
    if (isset($response_array)) {
        echo json_encode($response_array);
    }
}
?>