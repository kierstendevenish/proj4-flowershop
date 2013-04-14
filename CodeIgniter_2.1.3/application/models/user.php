<?php

Class User extends CI_Model
{

	function login($username, $password)
	{
		$db = new PDO('sqlite:./application/db/flowershop');
		$result = $db->query("SELECT * FROM Users WHERE username='" . $username . "' AND password='" . $password . "' LIMIT 1;");


		if(count($result) == 1)
		{
		     return $result;
		}
		else
		{
		     return false;
		}
	}
        
        function getEsl($username)
        {
                $db = new PDO('sqlite:./application/db/flowershop');
                $result = $db->query("SELECT esl FROM Users WHERE username='" . $username . "' LIMIT 1;");
                
                if(count($result) == 1)
                {
                    foreach ($result as $row)
                    {
                        $esl = $row['esl'];
                    }
                    
                    return $esl;
                }
                
                return '';
        }
        
        function setEsl($username, $esl)
        {
                $db = new PDO('sqlite:./application/db/flowershop');
                $result = $db->query("UPDATE Users SET esl='" . $esl . "' WHERE username='" . $username . "';");
        }
     
        
        function register($username, $password, $phone, $esl)
        {
                $db = new PDO('sqlite:./application/db/flowershop');
                $result = $db->query("INSERT INTO Users VALUES ('" . $username . "','" . $password . "','" . $esl . "');");
        }
        
        function getALlEsls()
        {
                $db = new PDO('sqlite:./application/db/flowershop');
                $result = $db->query("SELECT esl FROM Users;");

                if(count($result) >= 1)
                {
                    $data = array();

                    foreach ($result as $row)
                    {
                        array_push($data, $row['esl']);
                    }

                    return $data;
                }
                
                return $result;
        }
}
?>