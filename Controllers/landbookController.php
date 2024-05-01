<?php
session_start();
require_once('../Models/graveModel.php');
$approvedList = array();
$pendingList = array();
$rejectedList = array();
$cookieList = array();
$numRows = 22;
$numCols = 30;
for ($row = 0; $row < $numRows; $row++) 
{
    for ($col = 0; $col < $numCols; $col++) 
    {
        $approvedList[$row][$col] = "";
        $pendingList[$row][$col] = "";
        $rejectedList[$row][$col] = "";
        $cookieList[$row][$col] = "";
        $expiringDateS[$row][$col] = "";
    }
}


if (isset($_POST["checkup"]) && $_POST['checkMobile'] != "")
{
    //$resultSession1 = controlMobile($_POST['checkMobile']);
    $mobC=$_SESSION['on'] = $_POST['checkMobile'];
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
            
			//echo $buttonId;
            list($_, $row, $col) = explode('_', $buttonId);
            if ($row >= 0 && $row < $numRows && $col >= 0 && $col < $numCols && $rowSession["booked"] == 1 && $rowSession["rejected"]==0 && $rowSession["pending"] != 1)
            {
				$approvedList[$row][$col] = $buttonId;
                //$expiringDateS[$row][$col] = $rowSession["Expiring_date"];

            }
             if ($row >= 0 && $row < $numRows && $col >= 0 && $col < $numCols && $rowSession["pending"] == 1 && $rowSession["booked"] == 1)
            {
				$pendingList[$row][$col] = $buttonId;
                //$expiringDateS[$row][$col] = $rowSession["Expiring_date"];
            }
             if ($row >= 0 && $row < $numRows && $col >= 0 && $col < $numCols && $rowSession["booked"] == 0 && $rowSession["rejected"]==1)
            {
				$rejectedList[$row][$col] = $buttonId;
                //$expiringDateS[$row][$col] =date('Y-m-d', strtotime($rowSession["Expiring_date"])); 
            }
            $expiringDateS[$row][$col] =date('Y-m-d', strtotime($rowSession["Expiring_date"]));
            
        }
		$_SESSION['$approvedList'] = $approvedList;
		$_SESSION['$pendingList'] = $pendingList;
		$_SESSION['$rejectedList'] = $rejectedList;
        $_SESSION['$expiringDateS'] = $expiringDateS;
    }
    else if ($resultSession1-> num_rows == 0)
    {
        $_SESSION['$resultSession'] = $resultSession = 1;
    }
    //print_r ( $_SESSION['$expiringDateS']);
    header("location:../Views/landbook.php");
    exit();
	
}

if (isset($_POST["session_del"]))
{
    session_unset();
    session_destroy();
    for ($row = 0; $row < $numRows; $row++) 
    {
        for ($col = 0; $col < $numCols; $col++) 
        {
            $approvedList[$row][$col] = "";
            $pendingList[$row][$col] = "";
            $rejectedList[$row][$col] = "";
        }
    }
    header("location:../Views/landbook.php");
    exit();
}

if (isset($_POST["submit"]))
{
    $count = 0;
    $selectedCheckboxes = array();
    for ($row = 0; $row < $numRows; $row++) 
    {
        for ($col = 0; $col < $numCols; $col++) 
        {
            $buttonId = "land_${row}_${col}";
            if (isset($_POST[$buttonId]))
            {
                $count++;
                $selectedCheckboxes[] = $buttonId;
            }
        }
    }
    echo $count;
    $_SESSION['selectedCheckboxes'] = $selectedCheckboxes;
    if ($count == 0)
    {
        $_SESSION['insertedNoBook'] = 0;
        $checkBox1 = null;
    }
    $name = $_POST['name'];
    $name = $_POST['name'];
    $Representative_name = "Self";
    $expiringDate = $_POST["expiring_date"];
    $formattedDate = date('Y-m-d', strtotime($expiringDate));
    $mobile= $_POST['mobile'];

    if (empty($_POST['name']))
    {
        $nameError = $_SESSION['nameError'] = "Name is required";
    }

    if (empty($_POST['mobile'])) 
    {
        $mobileError = $_SESSION['mobileError'] = "Mobile number is required";
    }
    
    if (empty($_POST['expiring_date'])) 
    {
        $dateError = $_SESSION['dateError'] = "Expiring date is required";
    }

    if (empty($nameError) && empty($emailError) && empty($mobileError) && empty($dateError) && empty($checkBox1))
    {
        $submittedToken = $_SESSION['submittedToken']= $_POST['token'];
        if (in_array($submittedToken, $_SESSION['form_tokens']))
        {    
            if (is_array($selectedCheckboxes) && !empty($selectedCheckboxes))
            {
                foreach ($selectedCheckboxes as $checkbox)
                {
                    $result = insertNewBook($name,  $mobile, $formattedDate, $checkbox);
                    
                }
                if ($result)
                {
                    $_SESSION['removeToken'] = 1;
                }
            }
            
        }
        
    }
    else
    {
        $_SESSION['removeToken'] = 0;
        header("location:../Views/landbook.php");
        exit();
    }
}

if (isset($_POST['cookie_save']))
{
    for ($row = 0; $row < $numRows; $row++)
    {
        for ($col = 0; $col < $numCols; $col++)
        {
            $buttonId = "land_${row}_${col}";
            if (isset($_POST[$buttonId]))
            {
                echo "cookie".$buttonId;
                $cookie_name = $buttonId;
                $cookie_value = $buttonId;
                setcookie($cookie_name, $cookie_value, time() + 15);
                setcookie("on1", "on1", time() + 1500);
                $_COOKIE[$buttonId] = $buttonId;
                echo $_COOKIE[$buttonId];
                $_SESSION[$buttonId] = $buttonId;
            }
        }
    }
}
if (isset($_POST["cookie_del"]))
{
    $cookie_value="red";
    setcookie("cookie_name","", time() -3600);
    for ($row = 0; $row < $numRows; $row++)
    {
        for ($col = 0; $col < $numCols; $col++)
        {
            $buttonId = "land_${row}_${col}";
            if(isset($_SESSION[$buttonId]))
            {
                unset($_SESSION[$buttonId]);
            }
        }
    }
}
header("location:../Views/landbook.php");
exit();
?>