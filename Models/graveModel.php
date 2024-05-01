<?php 
require_once('db.php');
/*function generateGmodel()
{
    $conn=getConnection();
    $sql = "SELECT checkbox FROM grave_yard WHERE booked = 1;";
    $result = $conn->query($sql);
    return $result;    
}*/
function authMobile($mobile)
{
     $conn=getConnection();
     $sql1 = "SELECT C_ID, name, Expiring_date, checkbox, booked, rejected, pending FROM grave_yard WHERE mobile = '$mobile'";
     $res= mysqli_query($conn,$sql1);
     //$count=mysqli_num_rows($res);
     return $res;    
}
function insertNewBook($name,  $mobile, $formattedDate, $checkbox)
{
     $conn=getConnection();
     $sql = "INSERT INTO grave_yard (Name, mobile, Representative_name, Expiring_date, checkbox, booked, rejected, pending) VALUES ('$name',  $mobile, 'Self', '$formattedDate', '$checkbox', 1,0,1)";
     $result = $conn->query($sql);
     if ($result)
     {
         return true;
     }
     else
     {
         return false;
     }
}
function generateGmodel()
{
    $disabledList = array();
    $numRows = 22;
    $numCols = 30;
    for ($row = 0; $row < $numRows; $row++) 
    {
        for ($col = 0; $col < $numCols; $col++) 
        {
            $disabledList[$row][$col] = "";
        }
    }
    $conn = getConnection();
    $sql = "SELECT checkbox FROM grave_yard WHERE booked = 1;";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) 
    {
        // Extract the checkbox value
        $checkboxValue = $row['checkbox'];
        $checkboxValue = str_replace("land_", "", $row['checkbox']);

        // Split the string and extract row and col
        $parts = explode('_', $checkboxValue);
        if (count($parts) >= 2) 
        {
            $rowIndex = $parts[0];
            $colIndex = $parts[1];
            $disabledList[$rowIndex][$colIndex] = $row['checkbox'];
        }
    }

    return $disabledList;
}

?>