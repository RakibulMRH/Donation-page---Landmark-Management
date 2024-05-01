<?php
session_start();
require_once('../Models/donationModel.php');
require "vendor/autoload.php";
if (isset($_POST['submit'])) 
{
    $_SESSION['nameD'] =  $name = $_POST['name'];
    $_SESSION['emailD'] = $email = $_POST['email'];
    $_SESSION['regionD'] = $region = $_POST['region'];
    $_SESSION['amountD'] = $amount = $_POST['amount'];
    $_SESSION['messageD'] = $message = $_POST['message'];
    $_SESSION['eventIdD'] = $eventId = $_POST['eventId2'];
    $_SESSION['donation_type'] = $donation_type = $_POST['donation_type'];
    // Validate the input fields
    if (empty($name)) {
        $nameError = $_SESSION['nameErrorD'] = "Name is required";
    }

    if (empty($email)) {
        $emailError = $_SESSION['emailErrorD'] = "Email is required";
    }

    if (empty($region)) 
    {
        $regionError = $_SESSION['regionErrorD'] = "Region is required";
    }

    if (empty($amount)) 
    {
        $amountError = $_SESSION['amountErrorD'] = "Amount is required";
    }

    if (empty($nameError) && empty($emailError) && empty($regionError) && empty($amountError)) {
        $submittedToken = $_SESSION['submittedToken'] = $_POST['token'];

        if (in_array($submittedToken, $_SESSION['form_tokens'])) 
        {
            // Form submission is valid; insert data into the database
            addDonation($name, $email, $region, $amount, $message, $eventId);

            $_SESSION['removeTokenD'] = 1;

        } 
            else 
            {
                // Form submission is not valid; display an error
                $_SESSION['removeTokenD'] = 0;
            }
    }
}
header("location:../Views/donation.php");
exit();
?>