<?php
	
	cors();
	
	$inData = getRequestInfo();
	
	$dbhost = "localhost";
	$dbuser = "cop4331a_root";
	$dbpass = "!qwerty123$";
	$dbname = "cop4331a_db";
	
	foreach (getallheaders() as $name => $value)
	{ 
        if (strcmp($name, "Firstname") == 0)
        {
            $firstName = $value;
        }
        elseif(strcmp($name, "Lastname") == 0)
        {
            $lastName = $value;
        }
        elseif(strcmp($name, "Email") == 0)
        {
            $email = $value;
        }
        elseif(strcmp($name, "Phonenumber") == 0)
        {
            $phoneNumber = $value;
        }
        elseif(strcmp($name, "Address") == 0)
        {
            $address = $value;
        }
        elseif(strcmp($name, "City") == 0)
        {
            $city = $value;
        }
        elseif(strcmp($name, "State") == 0)
        {
            $state = $value;
        }
        
        elseif(strcmp($name, "Zip") == 0)
        {
            $zip = $value;
        }
        
        elseif(strcmp($name, "Userid") == 0)
        {
            $userID = $value;
        }
        echo "$name: $value\n";
    }

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
    if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
    } 
    

	else
	{
        $sql = "insert into Contacts (FirstName,LastName,Email,PhoneNumber,Address,City,State,Zip,UserID) VALUES ('" . $firstName . "','" . $lastName . "','" . $email . "','" . $phoneNumber . "','" . $address . "','" . $city . "','" . $state  . "','" . $zip . "','" . $userID . "')";

        if( $result = $conn->query($sql) != TRUE )
		{
			returnWithError( $conn->error );
		}
		$conn->close();
	}
	
	returnWithError("");
	
	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
    function cors() 
    {

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
    
        echo "You have CORS!";
    }
	
?>