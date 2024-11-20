<?php
require_once 'config.php';
// array for JSON response
$response = array();
$con= mysqli_connect($server,$user,$mp,$database);
// get all Amis from  table
$result = mysqli_query($con,"SELECT *FROM position") or die(mysqli_error());
// check for empty result
if (mysqli_num_rows($result) > 0) {
	 // success
    $response["success"] = 1;
    // looping through all results
    // Ami node
    $response["positions"] = array();
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $une_position = array();
        $une_position["idPosition"] = $row["idPosition"];
		$une_position["pseudo"] = $row["pseudo"];
		$une_position["numero"] = $row["numero"];
		$une_position["longitude"] = $row["longitude"];
		$une_position["latitude"] = $row["latitude"];
		  
        array_push($response["positions"], $une_position);
    }
    
} else {
    // no Ami found
    $response["success"] = 0;
    $response["message"] = "No position found";

}
// echo result
    echo json_encode($response);
?>