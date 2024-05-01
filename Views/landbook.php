<?php 
session_start();
setcookie('on', 'on', time() + 3600);
require_once('../Models/graveModel.php');
$token = uniqid();
if (!isset($_SESSION['form_tokens'])) 
{
    $_SESSION['form_tokens'] = [];
}
$_SESSION['form_tokens'][] = $token;
$mobile="";
$cookie_value="purple";
$savebox = "";
$numRows = 22;
$numCols = 30;
$cookie_name = "cookie_name";
$session_name="Guest";
$nameError="";
$dateError="";
$mobileError="";
$mobileeError="";
$approvedList = array();
$pendingList = array();
$rejectedList = array();
$cookieList = array();
$resultSession = 0;

for ($row = 0; $row < $numRows; $row++) 
{
    for ($col = 0; $col < $numCols; $col++) 
    {
        $approvedList[$row][$col] = "";
        $pendingList[$row][$col] = "";
        $rejectedList[$row][$col] = "";
        $resultModel[$row][$col] = "";
        $expiringDateS[$row][$col] = "";
    }
}

if (isset($_POST['checkup'])) 
{
    $mobileeE = $_POST['checkMobile'];
    if (empty($mobileeE)) 
    {
        $mobileeError = "Mobile number is required";
    }
}
if (isset($_SESSION['inside']) )
{
    //$resultSession1 = controlMobile($_POST['checkMobile']);
    $mobC=$_SESSION['on'];
	$resultSession1= authMobile($mobC);
	$_SESSION['resultSession1']=$resultSession1;
	//print_r($resultSession1);

	if ($resultSession1 -> num_rows > 0 )
    {
        while ($rowSession = mysqli_fetch_assoc($resultSession1))
        {
            $_SESSION['C_ID'] = $rowSession["C_ID"];
            $_SESSION['name'] = $rowSession["name"];
            $_SESSION['mobile'] = $mobC;
            $buttonId = $rowSession["checkbox"];

            list($_, $row, $col) = explode('_', $buttonId);
            if ($row >= 0 && $row < $numRows && $col >= 0 && $col < $numCols && $rowSession["booked"] == 1 && $rowSession["rejected"]==0 && $rowSession["pending"] != 1)
            {
				$approvedList[$row][$col] = $buttonId;
            }
             if ($row >= 0 && $row < $numRows && $col >= 0 && $col < $numCols && $rowSession["pending"] == 1 && $rowSession["booked"] == 1)
            {
				$pendingList[$row][$col] = $buttonId;
            }
             if ($row >= 0 && $row < $numRows && $col >= 0 && $col < $numCols && $rowSession["booked"] == 0 && $rowSession["rejected"]==1)
            {
				$rejectedList[$row][$col] = $buttonId;
            }
            $expiringDateS[$row][$col] =date('d M, Y', strtotime($rowSession["Expiring_date"]));
            
        }
		$_SESSION['$approvedList'] = $approvedList;
		$_SESSION['$pendingList'] = $pendingList;
		$_SESSION['$rejectedList'] = $rejectedList;
        $_SESSION['$expiringDateS'] = $expiringDateS;
    }
}

if (isset($_SESSION['on']) )
{   
    $_SESSION['inside'] = 1;
    if(isset($_SESSION['C_ID']))
    {
        $rejectedList = $_SESSION['$rejectedList'];
        $pendingList = $_SESSION['$pendingList'];
        $approvedList = $_SESSION['$approvedList'];
        $expiringDateS = $_SESSION['$expiringDateS'];
        $C_ID = $_SESSION['C_ID'];
        $name = $_SESSION['name'];
        $mobile = $_SESSION['mobile'];
    }
    
    if(isset($_SESSION['$resultSession']))
    {
        $resultSession = $_SESSION['$resultSession']; 
        unset($_SESSION['$resultSession']);
       
    }
}

//cookie starts here

?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Landmarks - Darussalam</title>
    <link rel="icon" href="assets/logo-darussalam.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .hidden-checkbox:checked + .color-button 
        {
            background-color: <?php echo $cookie_value;?>;
        }
    <?php include 'landStyle.php'; ?>
    
</head>
<body>
    <?php include 'header.php'; ?>
    <fieldset style="border: 0px"><h1 style="color: purple; text-align: center;">Fill out the Application form below to apply for a new Booking!</h1>
    <div class="color-container">
        <div class="color-box lightgray"></div><label>Choosable</label>
        <div class="color-box indianred"></div><label>Occupied </label>
        <div class="color-box purple"></div><label>Selected </label>
        <div class="color-box cyan"></div><label>Saved choice </label>
        <div class="color-box darkgreen"></div><label>Approved </label>
        <div class="color-box yellow"></div><label>Pending </label>
    </div>
    </fieldset>

    <h5 style="color: solid black; text-align: center;"><marquee behavior="scroll" direction="left" width="80%">To enhance accessibility, transparency, and convenience, we have transitioned our services online. This move is in response to the increasing number of requests and the complexities associated with documentation and authorization.</marquee></h5>
    
    <form method="post" action = "../Controllers/landbookController.php">
        <table border="0" style="width: auto;">
            <tr>
                <th>
                    <label for="checkMobile">To check the status of your Application enter the applicant's Mobile Number: </label>
                    <input type="text" name="checkMobile" pattern="01[3-9]\d{8}" maxlength="11" placeholder="Enter your Bangladeshi Mobile Number (e.g., 01XXXXXXXXX)"title="Please enter a valid Bangladeshi mobile number">
                    <input type="submit" name="checkup" value="Check for Update"><br>
                    <span class="error"><?php echo $mobileeError; ?></span><input type="hidden" name="token" value="<?php echo $token; ?>"><br>
                </th>
                <th>
                    <fieldset style="width: auto; max-width: 90%; display: inline-block; text-align: right;">
                        ٱلسَّلَامُ عَلَيْكُمْ,
                        <?php
                        if (isset($_SESSION['on']) && isset($_SESSION['name']) && $resultSession != 1 )
                        {
                            echo $_SESSION['name'];
                        }
                        else
                        {
                            echo "Ikhwan!" ;
                        }?>
                    </fieldset>
                </th>
            </tr>
            <tr>
                <td>
                    <table border="0" style="color: purple;">
                        <tr>
                            <?php
                                if (isset($_SESSION['nameError']))
                                {
                                    $nameError = $_SESSION['nameError'];
                                    unset($_SESSION['nameError']);
                                }

                                if (isset($_SESSION['mobileError']))
                                {
                                    $mobileError = $_SESSION['mobileError'];
                                    unset($_SESSION['mobileError']);
                                }

                                if (isset($_SESSION['dateError']))
                                {
                                    $dateError = $_SESSION['dateError'];
                                    unset($_SESSION['dateError']);
                                }
                                
                                if (isset($_SESSION['submittedToken']))
                                {
                                    $submittedToken = $_SESSION['submittedToken'];
                                    unset($_SESSION['submittedToken']);
                                    if (in_array($submittedToken, $_SESSION['form_tokens']))
                                    {    
                                        if (isset($_SESSION['removeToken']) == 1)
                                        {
                                            $selectedCheckboxes = $_SESSION['selectedCheckboxes'];
                                            echo '<p><b><span class="green-text">Apllication sent Successfully, </span></b>for the Selected Landmark: <b><span class="purple-text">';
                                            echo implode(", ", $selectedCheckboxes);
                                            echo "</b></span>!</p>";
                                            $_SESSION['form_tokens'] = array_diff($_SESSION['form_tokens'], [$submittedToken]);
                                            unset($_SESSION['selectedCheckboxes']);
                                            unset($_SESSION['submittedToken']);
                                        }
                                        
                                    }
                                   
                                }
                                if (isset($_SESSION['insertedNoBook'])) 
                                { 
                                    echo '<span class="red-text">No Landmark selected!</span>'; 
                                    unset($_SESSION['insertedNoBook']);
                                }
                        

                        if(!isset($_COOKIE['cookie_name']))
                        {
                            $cookie_value="purple";
                            for ($row = 0; $row < $numRows; $row++) 
                            {
                                for ($col = 0; $col < $numCols; $col++) 
                                {
                                    $cookieList[$row][$col] = "";
                                }
                            }
                        }

                        /*LandMark Generator*/
                        $resultModel = generateGmodel();
                        //print_r($_COOKIE);
                        for ($row = 0; $row < $numRows; $row++)
                        {
                            echo '<tr>';
                            for ($col = 0; $col < $numCols; $col++)
                            {
                                $buttonId = "land_${row}_${col}";
                                
                                if ($resultModel[$row][$col] == $buttonId) 
                                {$disabled = true;}
                                else { $disabled = false;}
                                
                                if( isset($_SESSION[$buttonId]))
                                {
                                    //$cookie_value = 'darkcyan';
                                    $cookieList[$row][$col] = $buttonId;
                                }
                                else
                                {
                                    //$cookie_value = 'purple';
                                    $cookieList[$row][$col] = "";
                                }
                                if( $cookieList[$row][$col] == $buttonId  )
                                {
                                    echo "<td>";
                                    echo "<input type='checkbox' name='$buttonId' id='$buttonId' class='hidden-checkbox' " . ($disabled ? 'disabled' : '') . " checked>";
                                    echo "<label for='$buttonId' class='color-button'></label>";
                                    echo "</td>";
                                }

                                if(isset($_SESSION['on']) && $approvedList[$row][$col] == $buttonId )
                                {
                                    echo "<td>";
                                    echo "<input type='checkbox' name='$buttonId' id='$buttonId' class='approved-checkbox' " . ($disabled ? 'disabled' : '') . ">";
                                    echo "<label for='$buttonId' class='colorappv-button'></label>";
                                    echo "</td>";

                                }

                                if( isset($_SESSION['on']) && $pendingList[$row][$col] == $buttonId )
                                {
                                    echo "<td>";
                                    echo "<input type='checkbox' name='$buttonId' id='$buttonId' class='pending-checkbox' " . ($disabled ? 'disabled' : '') . ">";
                                    echo "<label for='$buttonId' class='colorpending-button'></label>";
                                    echo "</td>";
                                }

                                else if($cookieList[$row][$col] != $buttonId && $approvedList[$row][$col] != $buttonId && $pendingList[$row][$col] != $buttonId)
                                {
                                    echo "<td>";
                                    echo "<input type='checkbox' name='$buttonId' id='$buttonId' class='hidden-checkbox' " . ($disabled ? 'disabled' : '') . ">";
                                    echo "<label for='$buttonId' class='color-button'></label>";
                                    echo "</td>";
                                }
                            }
                            echo '</tr>';
                        }?>
                    </tr>
                </td>
            </tr>
        </table>
        <td>
            <fieldset style="width: auto; height: auto;">
                <?php
                if (isset($_SESSION['on']) && isset( $_SESSION['name']) &&  $resultSession != 1 )
                {
                    echo '<h2 style="color: #7b7805; "><hr>User Information<hr></h2><b>';
                    echo  "Application ID:". $_SESSION['C_ID'] .'<br><hr width="50%">';
                    echo  "Name:".$_SESSION['name'] . '<br><hr width="50%">';
                    echo ' <table border="2">
                        <tr><th>';
                            echo '<b>Applied Landmark</b>
                            </th><b>
                            <th>Status</b></th>
                            </th><b>
                            <th style=" min-width: 150px;">Expiring Date</b></th>
                        </tr>';

                    $sessionMobile = $_SESSION['mobile'];

                    for ($row = 0; $row < $numRows; $row++)
                    {
                        for ($col = 0; $col < $numCols; $col++)
                        {
                            if($approvedList[$row][$col] != "")
                                {
                                    $btn = $approvedList[$row][$col];
                                    //echo "ok".$approvedList[$row][$col];
                                    echo '<tr>';
                                    echo '<td>' . $approvedList[$row][$col] . '</td>';
                                    echo '<td><h4 style="color: green; display: inline;">Approved!</h4></td>';
                                    echo '<td class="countdown" data-expiration="' . htmlspecialchars($expiringDateS[$row][$col], ENT_QUOTES, 'UTF-8') . '">';
                                    echo $expiringDateS[$row][$col] . '</td>';
                                    echo '</tr>';

                                    
                                }
                            else if($pendingList[$row][$col] != "")
                            {
                                echo '<tr>';
                                echo '<td>' . $pendingList[$row][$col] . '</td>';
                                echo '<td><h4 style="color: yellow; display: inline;">Pending!</h4></td>';
                                echo '<td class="countdown" data-expiration="' . htmlspecialchars($expiringDateS[$row][$col], ENT_QUOTES, 'UTF-8') . '">';
                                    echo $expiringDateS[$row][$col] . '</td>';
                                echo '</tr>';
                                
                                
                            }
                            else if($rejectedList[$row][$col] != "")
                            {
                                echo '<tr>';
                                echo '<td>' . $rejectedList[$row][$col] . '</td>';
                                echo '<td><h4 style="color: red; display: inline;">Rejected!</h4></td>';
                                echo '<td class="countdown" data-expiration="' . htmlspecialchars($expiringDateS[$row][$col], ENT_QUOTES, 'UTF-8') . '">';
                                echo $expiringDateS[$row][$col] . '</td>';
                                echo '</tr>';
                            }
                        }
                    }
                    echo '</table><br>';
                    echo '<input type="submit" name="session_del" value="Log Out">';
                }

                if ( $resultSession == 1 )
                {   
                    echo '<h1 style="color: red;">No Information Found!</h1>';

                }?>
                <hr>
                
                <h2 style="color: #7b7805;"> Aplication Form </h2><hr>
                <label for="name"><b>Name: </b></label><input type="text" name="name" style="width:auto;" placeholder="Enter your Name"><span class="error"><?php echo $nameError; ?></span><br><br>
                <label for="name"><b>Mobile: </b></label>
                <input type="text" name="mobile" pattern="01[3-9]\d{8}" maxlength="11" placeholder="Enter your Bangladeshi Mobile Number (e.g., 01XXXXXXXXX)"title="Please enter a valid Bangladeshi mobile number" style="width:auto;"><span class="error"><?php echo $mobileError; ?></span><br><br>
                <b>Expiring Date: </b><input type="date" name="expiring_date"><span class="error"><?php echo $dateError; ?></span><br><br> <br>
                <input type="submit" name="submit" value="Confirm Selection">
                <input type="submit" name="cookie_save" value="Save choice & Refresh">
                <input type="submit" name="cookie_del" value="Clear Cookies"><br> <br>
            </fieldset>
        </td>
        </table>
    </form>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var countdownElements = document.querySelectorAll('.countdown');

    countdownElements.forEach(function(element) {
        var expirationDate = new Date(element.getAttribute('data-expiration')).getTime();

        var countdownFunction = setInterval(function() {
            var now = new Date().getTime();
            var timeLeft = expirationDate - now;

            var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            element.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

            if (timeLeft < 0) {
                clearInterval(countdownFunction);
                element.innerHTML = "EXPIRED";
            }
        }, 1000);
    });
});
</script>


</body>
</html>