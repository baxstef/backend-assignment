<?php

function read(){
$db = new dbObj();
$connection =  $db->getConnstring();

$sql = 'SELECT * FROM ship_positions';
$result=mysqli_query($connection, $sql);
return $result;
}


function array_to_xml( $array, $xml, $xmls ) {
    foreach($array as $data){
    $node=$xml->addChild($xmls);
    foreach( $data as $key => $value ) {
             if ($value==""){
                 $value = ' ';
             }
            if( is_array($value) ) {
            if( is_numeric($key) ){
                $key = 'item'.$key; 
            }
            } 
            $node->addChild("$key",("$value"));
     }
     }
}

function array_to_csv( $array) {
    $fp = fopen('php://output', 'wb');
    foreach ($array as $fields) {
    fputcsv($fp, $fields);
    }
    fclose($fp);
}

function array_to_json( $array) {
    foreach($array as $data){
    $myJSON = json_encode($data);
    echo $myJSON;
    }
}

///////function user

function loguser() {
$date=date('Y-m-d H:i:s');
$ipaddress = $_SERVER['REMOTE_ADDR'];
$path = $_SERVER['REQUEST_URI'];
$line = $date . " - ".$ipaddress. " - ".$path;
file_put_contents('../../log/user.log', $line . PHP_EOL, FILE_APPEND);
$useraccess=saveuser($date,$ipaddress);
    return $useraccess;
}
function saveuser($timeuser,$ip) {
$useraccess="";    
$db = new dbObj();
$connection =  $db->getConnstring();
    $countip="";
$countip=checkuser($ip,$timeuser); 
    $countip++;
if($countip>=10) {
    
$firsttimeuser=checktimeuser($ip,$timeuser); 
    
    $time = new DateTime($firsttimeuser);
$diff = $time->diff(new DateTime());
    $ifuserhours=$diff->h;
    if($ifuserhours<1){
        $useraccess="error";
        header("Location: ../../error.php"); 
         
    }else{
        $sql_del_user_ip = "delete from user where ip='".$ip."'";
$result_del_user_ip=mysqli_query($connection, $sql_del_user_ip);
    } 
}else{
    
$sql = "INSERT INTO user (ip,timeuser,countip) VALUES ( '".$ip."','".$timeuser."','".$countip."')";
$result=mysqli_query($connection, $sql);
    
} 
    return $useraccess;
}

function checkuser($ip,$timeuser) {
$db = new dbObj();
$connection =  $db->getConnstring();
$sql = "SELECT * FROM user where ip='".$ip."' ORDER BY id DESC LIMIT 1";
    $result=mysqli_query($connection,$sql);
    $getID = mysqli_fetch_assoc($result);
        $countip= $getID['countip'];
    return $countip;
}

function checktimeuser($ip,$timeuser) {
$db = new dbObj();
$connection =  $db->getConnstring();
$sql = "SELECT * FROM user where ip='".$ip."'";
    $result=mysqli_query($connection,$sql);
    $getID = mysqli_fetch_assoc($result);
        $timeuser= $getID['timeuser'];
    return $timeuser;
}


///////function readone

function readid($stationId){
$db = new dbObj();
$connection =  $db->getConnstring();  
$sql = 'SELECT * FROM ship_positions where stationId= '.$stationId.' ';
$result=mysqli_query($connection, $sql); 

if($result){
 
    http_response_code(200);
 
    echo array_to_json($result);
}
 
else{
    http_response_code(404);
 
    echo json_encode(array("message" => "stationId does not exist."));

}  
}

function readmmsi($mmsi){
$db = new dbObj();
$connection =  $db->getConnstring();  
$sql = 'SELECT * FROM ship_positions where mmsi= '.$mmsi.' ';
$result=mysqli_query($connection, $sql); 

if($result){
 
    http_response_code(200);
 
    echo array_to_json($result);
}
 
else{
    http_response_code(404);
 
    echo json_encode(array("message" => "mmsi does not exist."));

}  
}

function readCoordinates($minLat,$maxLat,$minLon,$maxLon){
$db = new dbObj();
$connection =  $db->getConnstring();  
$sql = 'SELECT * FROM ship_positions where lon >= '.$minLon.' AND lon <= '.$maxLon.' AND lat >= '.$minLat.' AND lat <= '.$maxLat.' ';
$result=mysqli_query($connection, $sql); 

if($result){
 
    http_response_code(200);
 
    echo array_to_json($result);
}
 
else{
    http_response_code(404);
 
    echo json_encode(array("message" => "error with value Lat and Lon."));

}  
}

function readtime($fromDate,$toDate){
   
$db = new dbObj();
$connection =  $db->getConnstring();  

$fromDate = date("Y-m-d H:i:s", strtotime($fromDate));
$toDate = date("Y-m-d H:i:s", strtotime($toDate));
    $sql = 'SELECT * FROM ship_positions where FROM_UNIXTIME(timestamp) >=  "'.$fromDate.'"  and  FROM_UNIXTIME(timestamp) <=  "'.$toDate.'"';
   $result=mysqli_query($connection, $sql); 

if($result){
 
    http_response_code(200);
 
    echo array_to_json($result);
}
 
else{
    http_response_code(404);
 
    echo json_encode(array("message" => "error with value fromDAte and toDate."));

}   
}
