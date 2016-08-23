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
        //switch category
        $usermessage = "Thank you for your enquiry.<br>";
        switch ($response_array["category"]) {
            case "1":
                $chosen_option = "I cannot afford to repay any of my loan on time";
                $usermessage .= "Please contact one of our advisers on 0113 887 3434 to discuss a repayment arrangement.  We want to help you if you are experiencing financial difficulties and can come to an arrangement you can afford to repay.";
                break;
            case "2":
                $chosen_option = "I can only make a partial payment towards my loan";
                $usermessage .= "Please contact one of our advisers on 0113 887 3434 to discuss a repayment arrangement.  We want to help you if you are experiencing financial difficulties and can come to an arrangement you can afford to repay.";
                break;
            case "3":
                $chosen_option = "I would like to apply for another loan with you";
                $usermessage .= "We welcome applications from our customers who have had a successfully completed loan in the past and we may be in a position to offer you a little bit more money than last time if you repaid your instalment/s on time.  Please contact one of our advisers on 0113 887 3434 who will start the process for you.";
                break;
            case "4":
                $chosen_option = "I would like to make a complaint";
                $usermessage .= "Please <a href='/complaints' title='CASH4UNOW.CO.UK Complaints'>click here</a> to be taken to the complaints page of our website.";
                break;
            case "5":
                $chosen_option = "I would like to apply to cancel the Continuous Payment Authority";
                $usermessage .= "We will respond to your enquiry as soon as possible.";
                break;
            default: 
                $chosen_option = "Other";
                $usermessage .= "We will respond to your enquiry as soon as possible.";
                break;
        }
        //send mail
        try {

            //email body
            $message_body = $name."\r\n<br>Email: ".$email."\r\n<br>Telephone: ".$tel."\r\n<br>Account Number: ".$account."\r\n<br>Category: ".$chosen_option."\r\n<br>Enquiry: ".$enquiry."\r\n";

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
                $response_array['message'] = $usermessage;
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