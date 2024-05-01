<?php
require_once('../Models/donationModel.php');

// Start the table
echo '<table>';

// Get the result from your donor wall function
$result = getDonorWall();

// Loop through the results
while ($r = mysqli_fetch_assoc($result)) {
    // For each donor, create a row in the table
    echo '<tr>';
    echo '<td>';
    echo '<span style="color: purple;"><b>' . $r["Name"] . '</b></span> donated ';
    echo '<span style="color: darkgoldenrod;"><b>' . $r["Amount"] . '</b></span> ৳ for <b><span style="color: #392ba7;">' . $r["eventName"] . '</span>; ';
    echo '<span style="color: darkgreen;">' . $r["Message"] . '</b></span>';
    echo '</td>';
    echo '</tr>';
    echo '<tr><td><hr style="border-color: burlywood;"></td></tr>';
}

// End the table
echo '</table>';
?>
