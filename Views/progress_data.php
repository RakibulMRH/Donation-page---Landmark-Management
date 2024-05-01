<?php
require_once('../Models/donationModel.php');
$eventResult =getEventResult();
$rowCount = mysqli_num_rows($eventResult);
echo '<table>';
if($rowCount > 0)
{
    
    while ($e = mysqli_fetch_assoc($eventResult)) 
    {
        $eventId = $e["eventId"];
        $eventName = $e["eventName"];
        $goal = $e["goal"];
        $description = $e["description"];
    }
    $amountresult = getAmount($eventId);

    if ($amountresult) 
    {
        $row = mysqli_fetch_assoc($amountresult);
        $progress = $row['totalAmount'];
    }
}
 if ( $rowCount > 0)
        {
            echo '<b>Fundraising for: <span style="color: #7b7805;"><abbr title="'.$description.'">'.$eventName.'</abbr></span></b><br>';
            $ppbar=($progress*100)/$goal ; 
            echo '<label for="progress">';
                    echo '<b>Raised (<span style="color: purple;">'.round($ppbar, 2).'%</span>) </b></label>';
                    echo '<b>৳<span style="color: darkgreen;">'.$progress.'</span> of <span style="color: darkred;"> '.$goal.'</span>৳</b><br>';

            echo '<progress id="file" max="100" value="'.$ppbar.'" style="width: 100%; max-width: 300px; min-width: 225px; height: 20px; background: #f0f0f0;">'.$progress.'</progress>';
        }
               /* <b>Raised (<span style="color: purple;"><?php echo round($ppbar, 2);?>%</span>) </b></label>
                    <b>৳<span style="color: darkgreen;"><?php echo $progress; ?></span> of <span style="color: darkred;"> <?php echo $goal; ?></span>৳</b><br>
            <progress id="file" max="100" value="<?php echo $ppbar; ?>" style="width: 100%; max-width: 300px; min-width: 225px; height: 20px; background: #f0f0f0;"><?php echo $progress; 
       </div>*/
?>
