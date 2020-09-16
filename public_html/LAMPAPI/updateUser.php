<?php
    cors();

    $inData = getRequestInfo();
    
    
    $firstName = $inData["FirstName"]; 
    $lastName = $inData["LastName"]; 
    $login = $inData["Login"]; 
    $password = $inData["Password"]; 

    foreach (getallheaders() as $name => $value)
	{ 
        if(strcmp($name, "Lastname") == 0)
        {
            $lastName = $value;
        }
        elseif(strcmp($name, "Firstname") == 0)
        {
            $firstName = $value;
        }
        elseif (strcmp($name, "Login") == 0)
        {
            $login = $value;
        }
        elseif(strcmp($name, "Password") == 0)
        {
            $password = $value;
        }
    }

    $conn = new mysqli("localhost", "cop4331a_root", "!qwerty123$", "cop4331a_db");
    if ($conn->connect_error) 
    {
        returnWithInfo('', '', '', '', "Connection error", $conn->connect_error);
    } 
    else
    {
        $sql = "UPDATE Users SET FirstName='" . $firstName . "',LastName='" . $lastName . "',Password='" . $password . "'" . "WHERE Login='" . $login ."'";
        
        if( $result = $conn->query($sql) != TRUE)
        {
            returnWithInfo('', '', '', '', "Database Error", $conn->connect_error);
        }
        else
        {
            returnWithInfo($firstName, $lastName, $login, $password, 'Success', '');
        }
        
        $conn->close();
    }
    

    function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true); 
    }
    
    function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
    }
    
    function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
    }

    function returnWithInfo($firstName, $lastName, $login, $password, $message, $error)
	{
		$retValue = '{"FirstName":"' . $firstName . '","LastName":"' . $lastName . '","Login":"'. $login . '","Password":"'. $password . '","message": "'. $message .'","error": "' . $error . '"}'; 
		sendResultInfoAsJson($retValue);
	}
    
    function cors() {

        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
    
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
    
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
            exit(0);
        }
    
    }
?>