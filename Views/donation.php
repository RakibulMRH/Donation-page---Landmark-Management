<?php
require_once('../Models/donationModel.php');
session_start();
$eventId = NULL;
$eventName = NULL;
$goal = NULL;
$description = NULL;
$servername = "localhost";
$email = "root";
$password = "";
$database = "darussalam";
// Generating a unique token for the form
$token = uniqid();
$progress = 0;
// Storing the token in the session
if (!isset($_SESSION['form_tokens'])) 
{
    $_SESSION['form_tokens'] = [];
}

$_SESSION['form_tokens'][] = $token;
$nameError = $emailError = $regionError = $amountError = "";

$eventResult =getEventResult();
$rowCount = mysqli_num_rows($eventResult);

if($rowCount > 0)
{
    while ($e = mysqli_fetch_assoc($eventResult)) 
    {
        $eventId = $e["eventId"];
        $eventName = $e["eventName"];
        $goal = $e["goal"];
        $description = $e["description"];
    }
}
else
{
    $developementOnly = 1;  
}

// Check if the form has been submitted

    if ( isset($_SESSION['nameErrorD'])) {
        $nameError = $_SESSION['nameErrorD'];
        unset($_SESSION['nameErrorD']);
    }

    if (isset($_SESSION['emailErrorD'])) {
        $emailError = $_SESSION['emailErrorD'];
        unset($_SESSION['emailErrorD']);
    }

    if (isset($_SESSION['regionErrorD'])) {
        $regionError = $_SESSION['regionErrorD'];
        unset($_SESSION['regionErrorD']);
    }

    if (isset($_SESSION['amountErrorD'])) {
        $amountError = $_SESSION['amountErrorD'];
        unset($_SESSION['amountErrorD']);
    }

    if (isset($_SESSION['removeTokenD']) == 1) 
    {
        $submittedToken = $_SESSION['submittedToken'];
        $_SESSION['form_tokens'] = array_diff($_SESSION['form_tokens'], [$submittedToken]);
        
        unset($_SESSION['submittedToken']);
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Donation-Darusslam</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="assets/logo-darussalam.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        <?php include 'donationStyle.php'; ?><br>
    </style>
    <script>
    function printPageArea(areaID){
    var printContent = document.getElementById(areaID).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
}
    </script>
    
</head>
<body>
    <?php include 'header.php'; ?><br>

    <div class="containerz">
        <h2 style="text-align: center;">
            Join us in our mission to educate and inspire Muslims and make your donation a continuous source of<br>
            <span class="green-text">Sadaqa Jariyah</span>
        </h2>
    </div>
    <table border="0" width="100%">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td style="text-align: right;">
                <div style="display: inline-block; text-align: center;">
                    <fieldset class="fieldset-none" style="width: auto; max-width: 300px; background: white;">
                        <h2 style="text-align: center; color: #7b7805">Donors Wall</h2><hr style="border-color: transparent;">
                        <div id="donorWall" style="overflow: auto; height: 600px;">
                        <?php 
                        $eventIdC = $eventId;
                        if ( $rowCount > 0)
                        {
                            $amountresult = getAmount($eventId);

                            if ($amountresult) 
                            {
                                $row = mysqli_fetch_assoc($amountresult);
                                $progress = $row['totalAmount'];
                            }
                        }?>
                       
                        
                        <div id="donorDisplay">
                        
                        </div>
                        
                        </div></b>
                </div>
            </td>
                </fieldset>
    <td style="width: auto; text-align: center;">
        <?php 
        if ( $rowCount == 0)
            {
                echo "<span style='color: #7b7805;'><b>No Active Event!<br>Your Donation directly goes to Darussalam's development.</b></span>";

            }?>
        <fieldset class="fieldset-rgb" style="width: auto; min-width: 400px; background: white;">
            <legend style="width: auto;">
                <p class="text"><h2 class="text-animation"><span></span></h2></p>
            </legend>

            <form method="post" action = "../Controllers/donationController.php">
            <input type="hidden" name="eventId2" value="<?php echo $eventId; ?>">
                <label for="name"><b>Name</b></label>
                <input type="text" name="name" id="name" placeholder="Enter your name"><br>
                <span class="error"><?php echo $nameError; ?></span><br>
                <label for="email"><b>Email</b></label>
                <input type="email" name="email" id="email" placeholder="Enter your email"><br>
                <span class="error"><?php echo $emailError; ?></span><br>
                <label for="region"><b>Region</b></label>
                <input type="text" name="region" id="region" placeholder="Enter your region"><br>
                <span class="error"><?php echo $regionError; ?></span><br>
                <hr width="60%">
                <label for="donation_type" style="text-align: left; font-weight: bold;">Donation Type</label><br>
                <hr width="80%">
                <input type="radio" name="donation_type" id="one_time" value="one_time" checked>
                <label for="one_time"><b>One Time Donation</b></label>
                <input type="radio" name="donation_type" id="monthly" value="monthly">
                <label for="monthly"><b>Monthly Donation</b></label>
                <br>
                <label for="amount" style="font-weight: bold;">Amount</label>
                <input type="number" name="amount" id="amount" placeholder="Enter amount">
                <span class="error"><?php echo $amountError; ?></span><br>

                <button type="button" class="custom-button" onclick="document.getElementById('amount').value='100'"><h4>৳100</h4></button>
                <button type="button" class="custom-button" onclick="document.getElementById('amount').value='500'"><h4>৳500</h4></button>
                <button type="button" class="custom-button" onclick="document.getElementById('amount').value='1000'"><h4>৳1000</h4></button>
                <br>

                <label for="message"><b>Message</b></label>
                <textarea name="message" id="message" placeholder="Enter your message" ;></textarea>

                <br>
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="submit" name="submit" value="Donate">

                <?php
                if(isset($_POST['donation_type']) && $_POST['donation_type'] == 'monthly' && empty($nameError) && empty($emailError) && empty($regionError) && empty($amountError))
                {
                    echo "<h3 style='color: blue;'>You can log in to edit your recurring donation any time</h3>";
                }?>

                <?php

                if (isset($_SESSION['removeTokenD']) )
                {
                    $name = $_SESSION['nameD'];
                    $email = $_SESSION['emailD'];
                    $region = $_SESSION['regionD'];
                    $amount = $_SESSION['amountD'];
                    $message = $_SESSION['messageD'];
                    $donation_type = $_SESSION['donation_type'];
                    //include 'payscript.php';
                    unset($_SESSION['removeTokenD']);
                    $latestSlSql = getLatestSl();

                    if ($latestSlSql)
                    {
                        $row = $latestSlSql->fetch_assoc();
                        $latestSerial = $row['latest_serial'];
                    }

                    

                    unset($_SESSION['nameD']);
                    unset($_SESSION['emailD']);
                    unset($_SESSION['regionD']);
                    unset($_SESSION['amountD']);
                    unset($_SESSION['messageD']);
                    unset($_SESSION['donation_type']);
                    
                    echo '<div id="printReceipt">'; 
                    echo '<fieldset class="fieldset-rgb">';
                    echo "<legend><b><h3>JazakAllah Khair</h3></b></legend>";
                    echo "<p><b>SL:</b> $latestSerial</p>";
                    echo "<p><b>Name:</b> $name</p>";
                    echo "<p><b>Email:</b> $email</p>";
                    echo "<p><b>Region:</b> $region</p>";
                    echo "<p><b>Amount:</b> $amount</p>";
                    echo "<p><b>Message:</b> $message</p>";
                    echo "<p><b>Donation Type:</b> $donation_type</p>";
                    echo "</fieldset>";
                    echo "</div>";
                    $_SESSION['form_submitted'] = false;
                    echo '<br><button onclick="printPageArea(\'printReceipt\')">Print Receipt</button>';
                }?>
            </form>
        </fieldset>
        
    </td>
    <td colspan="3">
    <div id = "progress">
        </div>

        
        <br><br>
        <fieldset class="fieldset-none" style="width: auto; max-width: 300px; min-width: 220px; background: white;">

            <h2 style="text-align: center; color: #7b7805;">Questions?</h2>
            <details>
                <summary style="color: purple;  cursor: pointer;text-align:  left ;">Do you accept Zakat?</summary>

                <p>We do not accept Zakat. We only accept Sadaqah.</p>

            </details>
            <br>
            <details>
                <summary style="color: purple;  cursor: pointer; text-align:  left ;">I don’t have online Card Payment options. How do I donate?<br> </summary>

                <p>Kindly mail us at <a href="mailto:contact@ds.org">contact@ds.org</a> so that we can figure out a suitable way for you to contribute.</p>

            </details>
            <br>
            <details>
                <summary style="color: purple; cursor: pointer; text-align: left;">Do you accept donations via PayPal?</summary>
                <p>Yes, we do. Please visit our PayPal fundraiser page to donate via PayPal.</p>
            </details> <br>
            
        </fieldset><br><br>
        <fieldset class="fieldset-none" style="width: auto; max-width: 300px; min-width: 220px;background: white;">
            <h2 style="text-align: center; color: #7b7805;">Contact Us</h2>
            <a href="https://www.facebook.com" class="fa-brands fa-facebook fa-xl" style="text-decoration: none;" target="_blank"></a>
            <span style="margin-right: 10px;"></span>
            <a href="https://www.instagram.com" class="fa-brands fa-instagram fa-xl" style="text-decoration: none;" target="_blank"></a>
            <span style="margin-right: 10px;"></span>
            <a href="https://www.linkedin.com" class="fa-brands fa-linkedin fa-xl" style="text-decoration: none;" target="_blank"></a>
            <span style="margin-right: 10px;"></span>
            <a href="https://www.twitter.com" class="fa-brands fa-twitter fa-xl" style="text-decoration: none;" target="_blank"></a><br>
            <br>Darussalam is registered by BD as charity, registration no. 1178251
        </fieldset>
    </td>
    </tr>
    </table>
    <script>
function donorWall() {
    var dw = new XMLHttpRequest();
    dw.onreadystatechange = function() {
        if (dw.readyState == 4 && dw.status == 200) {
            document.getElementById('donorDisplay').innerHTML = dw.responseText;
        }
    };
    dw.open('GET', 'donor_data.php', true);
    dw.send();
}
function progressBar() {
    var pb = new XMLHttpRequest();
    pb.onreadystatechange = function() {
        if (pb.readyState == 4 && pb.status == 200) {
            document.getElementById('progress').innerHTML = pb.responseText;
        }
    };
    pb.open('GET', 'progress_data.php', true);
    pb.send();
}
// Refresh the donorWall every 3 seconds
setInterval(donorWall, 3000);
setInterval(progressBar, 3000);

// Initial load
document.addEventListener('DOMContentLoaded', donorWall);
document.addEventListener('DOMContentLoaded', progressBar);
</script>
</body>
</html>
