<?php

	$search = "";
	$userID = 0;
	$searchResults = "";
	$searchCount = 0;

    foreach (apache_request_headers() as $name => $value)
	{
        if (strcmp($name, "Search") == 0)
        {
            $search = $value;
        }
        elseif(strcmp($name, "Userid") == 0)
        {
            $userID = $value;
        }
    }

	$conn = new mysqli("localhost", "cop4331a_root", "!qwerty123$", "cop4331a_db");
	
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$sql = "SELECT * FROM Contacts WHERE UserID = " . $userID . " AND (FirstName LIKE '%" . $search . "%' OR LastName LIKE '%" . $search ."%' OR Email LIKE '%" . $search ."%' OR PhoneNumber LIKE '%" . $search ."%' OR Address LIKE '%" . $search ."%' OR City LIKE '%" . $search . "%' OR State LIKE '%" . $search ."%' OR DateCreated LIKE '%" . $search ."%');";
		
		//echo $sql;
		
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0)
		{
		    $i = 0;
			foreach ($result as $contact)
			{
			    $json = json_encode($contact);
			    $searchResults .= $json;
			    
			    $i++;
			    if ($i < $result->num_rows)
			    {
			        $searchResults .= ',';
			    }
			}
		}
		else
		{
			returnWithError( "No Records Found" );
		}
		$conn->close();
	}

	returnWithInfo($searchResults);

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
	
	function returnWithInfo( $searchResults )
	{
		$retValue = '{"Results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>