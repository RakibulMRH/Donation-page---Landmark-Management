<?php 
require_once('db.php');
function addDonation($name, $email, $region, $amount, $message, $eventId)
{
     $conn=getConnection();
     $sql = "INSERT INTO donators (Name, Email, Region, Amount, Message, eventId) VALUES ('$name', '$email', '$region', $amount, '$message','$eventId')";
     mysqli_query($conn, $sql);
         
}

function getDonorWall()
{
     $conn=getConnection();
     $donorwall = "SELECT donators.*, event.eventName FROM donators JOIN event ON donators.eventId = event.eventId ORDER BY donators.SL DESC;";
     $result = mysqli_query($conn, $donorwall);
     return $result;   
}
function insBook($name,  $mobile, $formattedDate, $checkbox)
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

function getLatestSl()
{
     $conn=getConnection();
     $sql = "SELECT MAX(SL) AS latest_serial FROM donators;";
     $result = $conn->query($sql);
     return $result;    
}
function getEventResult()
{
     $conn=getConnection();
     $sql = "select * from event where status = 1;";
     $result = mysqli_query($conn, $sql);
     return $result;    
}

function getAmount($eventId)
{
     $conn=getConnection();
     $sql = "SELECT SUM(amount) AS totalAmount FROM donators WHERE eventId = $eventId;";
     $result = mysqli_query($conn, $sql);
     return $result;    
}

?>
