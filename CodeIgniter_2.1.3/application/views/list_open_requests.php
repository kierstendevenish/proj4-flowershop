<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
   <title>Flower Shop - Open Requests</title>
 </head>
 <body>
   <h1>Open delivery requests:</h1><br>
   <table border='1' rules='all'>
       <tr>
           <th>Pickup Time</th>
           <th>Delivery Time</th>
           <th>Delivery Address</th>
           <th>Driver</th>
           <th>Bids</th>
           <th>Picked Up</th>
       </tr>
   <?php if (count($requests) > 0):
        foreach ($requests as $req):
            echo "<tr><td>" . $req['pickupTime'] . "</td><td>" . $req['deliveryTime'] . "</td><td>" . $req['deliveryAddr'] . "</td><td>".$req['driverId']."</td><td>"; if ($req['driverId'] == null or $req['driverId'] == '') echo "<a href='viewBids/".$req['id']."'>Bids</a>"; echo "</td><td><a href='".base_url()."/index.php/delivery/pickedUp/".$req['id']."'>Picked Up</a></td></tr>";
        endforeach;
   endif; ?>
   </table>
 </body>
</html>