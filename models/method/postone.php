<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include("../../configuration/connection.php");
include("../../models/functions.php");
$log=loguser(); 
$db = new dbObj();
$connection =  $db->getConnstring();
 
 
if(isset($_GET['stationId'])) {
    $stationId = $_GET['stationId'];
} else {
    $stationId = '';
}
	
$sql = 'SELECT * FROM ship_positions where stationId= '.$stationId.' ';
$result=mysqli_query($connection, $sql); 

if($result){
 
    http_response_code(200);
 
    echo array_to_json($result);
}
 
else{
    http_response_code(404);
 
    echo json_encode(array("message" => "ID does not exist."));

}
?>