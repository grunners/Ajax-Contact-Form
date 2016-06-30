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
        "account" => $posted['txtAccount'],
        "category" => $posted['listCategory'],
        "enquiry" => $posted['txtEnquiry']
    );

    //validate fields - if no errors, continue with try/catch
    if (isset($response_array["name"])) {
        $name = filter_var($response_array["name"], FILTER_SANITIZE_STRING);
        } else {
        $name = "s";
        $errors = true;
        }
    if (isset($response_array["email"])) {
        $email = filter_var($response_array["email"], FILTER_SANITIZE_EMAIL);
        } else {
        $email = "";
        $errors = true;
        }
    if (isset($response_array["tel"])) {
        $tel = filter_var($response_array["tel"], FILTER_SANITIZE_NUMBER_INT);
        } else {
        $tel = "";
        $errors = true;
        }
    if (isset($response_array["account"])) {
        $account = filter_var($response_array["account"], FILTER_SANITIZE_NUMBER_INT);
        } else {
        $account = "";
        }
    if (isset($response_array["category"])) {
        $category = filter_var($response_array["category"], FILTER_SANITIZE_STRING);
        } else {
        $category = "";
        }
    if (isset($response_array["enquiry"])) {
        $enquiry = filter_var($response_array["enquiry"], FILTER_SANITIZE_STRING);
        } else {
        $enquiry = "";
        }

    if (isset($errors)) {
        //error
    }
    else
    {
        //send mail
        try {

            //email body
            $message_body = $name."\r\n<br>Email: ".$email."\r\n<br>Telephone: ".$tel."\r\n<br>Account Number: ".$account."\r\n<br>Category: ".$category."\r\n<br>Enquiry: ".$enquiry."\r\n";

            //proceed with PHP email.
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From: " . $companyname . " <" . $companyemail . ">" . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
           
            $send_mail = mail($companyemail, $subject, $message_body, $headers);
           
            if(!$send_mail)
            {
                $response_array["status"] = "error";
                $response_array['message'] = "There was a problem sending your contact request - please try again.";
            }
            else {
                $response_array["status"] = "success";
                $response_array['message'] = "Thank you for your enquiry, we will be in touch as soon as possible.";
            }
        }
        catch(Exception $e) {
            $response_array['message'] = "There was a problem sending your contact request - please try again.";
            $response_array["status"] = "error";
        }
    }

    //echo array back to the form
    if (isset($response_array)) {
        echo json_encode($response_array);
    }
}
?>