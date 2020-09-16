<?php

    $login = "";
    $userID = 0;
    
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
        elseif(strcmp($name, "Userid") == 0)
        {
            $userID = $value;
        }
    }
	
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if ($conn->connect_error) 
	{
		returnWithError($conn->connect_error);
	} 
	else
	{
		$sql = "DELETE FROM Users WHERE Login = " . "'" . $login. "'" . "AND ID = " . "'" . $Userid. "'";
		
		$result = $conn->query($sql);
		
        if (!$result)
        {
            returnWithError("Could not find record.");
        }
        else
        {
            returnWithInfo("Succesfully deleted '". $login . "'");
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
	
	function returnWithInfo($results)
	{
		$retValue = '{"results":' . $results . '"}';
		sendResultInfoAsJson($retValue);
	}
	
?>