<?php
session_start();
include("processConnectDB.php");
include("lucasLoavesFunctions.php");

$sql = "SELECT * FROM JOBPOST WHERE PostNumber = ".$_REQUEST['postNumber'];

$resultSet = mysqli_query($conn, $sql);



while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
{
    $jobDetails = $record;
}

echo json_encode($jobDetails);                            
?>