<?php

Class Request extends CI_Model
{
        function create($pickupTime, $deliveryAddr, $deliveryTime)
        {
                $id = uniqid();
                $db = new PDO('sqlite:./application/db/flowershop');
                $result = $db->query("INSERT INTO Requests (id, pickupTime, deliveryAddr, deliveryTime, delivered) VALUES ('" . $id . "','" . $pickupTime . "','" . $deliveryAddr . "','" . $deliveryTime . "',0);");

                return $id;
        }
        
        function allOpen()
        {
                $db = new PDO('sqlite:./application/db/flowershop');
                $result = $db->query("SELECT * FROM Requests WHERE delivered=0;");
                return $result;
        }

        function getShopName()
        {
            $db = new PDO('sqlite:./application/db/flowershop');
            $result = $db->query("SELECT dataValue FROM appDataString WHERE dataKey='shopName';");
            $row = $result->fetch();
            return $row['dataValue'];
        }

        function getShopCoordinates()
        {
            $db = new PDO('sqlite:./application/db/flowershop');
            $result = $db->query("SELECT dataValue FROM appDataString WHERE dataKey='shopLatitude';");
            $row = $result->fetch();
            $returnable['lat'] = $row['dataValue'];
            $result = $db->query("SELECT dataValue FROM appDataString WHERE dataKey='shopLongitude';");
            $row = $result->fetch();
            $returnable['long'] = $row['dataValue'];
            return $returnable;
        }

        function getShopEsl()
        {
            $db = new PDO('sqlite:./application/db/flowershop');
            $result = $db->query("SELECT dataValue FROM appDataString WHERE dataKey='shopEsl';");
            $row = $result->fetch();
            return $row['dataValue'];
        }

        function saveBid($deliveryId, $driverName, $estDeliveryTime, $rate)
        {
            $accepted = 0;

            $this->load->helper('date');
            $dtime = mdate("%Y-%m-%d %h:%i:%s", $estDeliveryTime);

            $db = new PDO('sqlite:./application/db/flowershop');
            $query = "INSERT INTO Bids (deliveryId, driverName, estimatedDeliveryTime, rate, accepted) VALUES ('".$deliveryId."','".$driverName."','".$dtime."',".$rate.",".$accepted.");";
            var_dump($query);
            $result = $db->query($query);
            var_dump($result);
        }

        function getBidsForRequest($requestId = '')
        {
            $db = new PDO('sqlite:./application/db/flowershop');
            $result = $db->query("SELECT * FROM Bids WHERE deliveryId='" . $requestId . "';");
            return $result;
        }

        function getGuildEsl()
        {
            $db = new PDO('sqlite:./application/db/flowershop');
            $result = $db->query("SELECT dataValue FROM appDataString WHERE dataKey='guildEsl';");
            $row = $result->fetch();
            return $row['dataValue'];
        }

        function markAccepted($deliveryId = '')
        {
            $db = new PDO('sqlite:./application/db/flowershop');
            $db->query("UPDATE Requests SET driverId=1 WHERE id='".$deliveryId."';");
        }

        function setDelivered($deliveryId = '')
        {
            $db = new PDO('sqlite:./application/db/flowershop');
            $db->query("UPDATE Requests SET delivered=1 WHERE id='".$deliveryId."';");
        }
}
?>