<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Flower Shop - Open Requests</title>
 </head>
 <body>
   <h1>Bids for delivery <?php echo $requestId; ?>:</h1><br>
   <table border='1' rules='all'>
       <tr>
           <th>Driver</th>
           <th>Estimated Delivery Time</th>
           <th>Rate</th>
           <th>Accept</th>
       </tr>
   <?php if (count($bids) > 0):
        foreach ($bids as $bid):
            echo "<tr><td>" . $bid['driverName'] . "</td><td>" . $bid['estimatedDeliveryTime'] . "</td><td>" . $bid['rate'] . "</td><td><a href='".base_url()."bid/accept/".$bid['deliveryId']."/".$bid['driverName']."'>Accept</a></td></tr>";
        endforeach;
   endif; ?>
   </table>
 </body>
</html>