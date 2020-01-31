<?php
include("/connection.php");
$db = new dbObj();
$connection =  $db->getConnstring();
 
$request_method=$_SERVER["REQUEST_METHOD"];



$strJsonFileContents = file_get_contents("../ship_positions.json");
$array = json_decode($strJsonFileContents, true);
$i=0;
$is=0;
$checkerror="";
foreach($array as $arrays){
$arrlength = count($arrays);
    $i++;


$sql="INSERT INTO ship_positions ( mmsi, status, stationId, speed, lon, lat, course, heading, rot, timestamp) VALUES ( ".$arrays["mmsi"].",".$arrays["status"].",".$arrays["stationId"].",".$arrays["speed"].",".$arrays["lon"].",".$arrays["lat"].",".$arrays["course"].",".$arrays["heading"].",'".$arrays["rot"]."',".$arrays["timestamp"].")";
    
    $result=mysqli_query($connection, $sql);
    if($result){
   $is++;
        
    }
    else {
        $checkerror=mysqli_error($connection);
        
    }
}
if($i==$is){
    echo "query Ok";
}else{
    echo "error ".$checkerror;
}

?>