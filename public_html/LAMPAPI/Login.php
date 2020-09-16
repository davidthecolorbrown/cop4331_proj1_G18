<?php

	$id = 0;
	$firstName = "";
	$lastName = "";

    $login = "FAIL";
    $password = "FAIL";
    
	$dbhost = "localhost";
	$dbuser = "cop4331a_root";
	$dbpass = "!qwerty123$";
	$dbname = "cop4331a_db";
	
	foreach (getallheaders() as $name => $value)
	{ 
        if (strcmp($name, "Login") == 0)
        {
            $login = $value;
        }
        elseif(strcmp($name, "Password") == 0)
        {
            $password = $value;
        }
    }
	
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if ($conn->connect_error) 
	{
		returnWithError($conn->connect_error);
	} 
	else
	{
		//$sql = "SELECT ID,FirstName,LastName FROM Users WHERE Login = " $login . " AND Password = " . $password;
		
		$sql = "SELECT ID,FirstName,LastName FROM Users WHERE Login = " . "'" . $login. "'" . "AND Password = " . "'" . $password. "'";
		
		
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$firstName = $row["FirstName"];
			$lastName = $row["LastName"];
			$id = $row["ID"];
			
			$result->free_result();
			
			returnWithInfo($firstName, $lastName, $id);
		}
		else
		{
			returnWithError("No Records Found");
		}
		$conn->close();
	}
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson($obj)
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError($err)
	{
		$retValue = '{"id":0,"FirstName":"","LastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo($firstName, $lastName, $id)
	{
		$retValue = '{"id":' . $id . ',"FirstName":"' . $firstName . '","LastName":"' . $lastName . '","error":""}';
		sendResultInfoAsJson($retValue);
	}
	
?>