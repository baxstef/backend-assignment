<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include("../../configuration/connection.php");
include("../../models/functions.php");
$log=loguser();
if($log=="error"){
  header("Location: ../../error.php");
    
} 
$db = new dbObj();
$connection =  $db->getConnstring();
 
 
if(isset($_GET['stationId'])) {
    $stationId = $_GET['stationId'];
readid($stationId);

} else {
    $stationId = '';
}
	
if(isset($_GET['mmsi'])) {
    $mmsi = $_GET['mmsi'];
readmmsi($mmsi);
} else {
    $mmsi = '';
}
	
if(isset($_GET['minLat'])) {
    $minLat = $_GET['minLat'];
} else {
    $minLat = '';
}
	
if(isset($_GET['maxLat'])) {
    $maxLat = $_GET['maxLat'];
} else {
    $maxLat = '';
}
	
if(isset($_GET['minLon'])) {
    $minLon = $_GET['minLon'];
} else {
    $minLon = '';
}
	
if(isset($_GET['maxLon'])) {
    $maxLon = $_GET['maxLon'];
} else {
    $maxLon = '';
}

if((isset($_GET['minLat']))&&(isset($_GET['maxLat']))&&(isset($_GET['minLon']))&&(isset($_GET['maxLon']))){
readCoordinates($minLat,$maxLat,$minLon,$maxLon);
}
if(isset($_GET['fromDate'])) {
    $fromDate = $_GET['fromDate'];
} else {
    $fromDate = '';
}
	
if(isset($_GET['toDate'])) {
    $toDate = $_GET['toDate'];
} else {
    $toDate = '';
}
if((isset($_GET['fromDate']))&&(isset($_GET['toDate']))){
 readtime($fromDate,$toDate);   
}
 

?>