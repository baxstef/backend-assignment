<?php
include("../../configuration/connection.php");
include("../../models/functions.php");


if(isset($_GET['format'])) {
    $format = $_GET['format'];
} else {
    $format = '';
}

if(isset($_GET['method'])) {
    $method = $_GET['method'];
} else {
    $method = '';
}
if(isset($_GET['stationId'])) {
    $stationId = $_GET['stationId'];
} else {
    $stationId = '';
}

$log=loguser();
if($log=="error"){
  header("Location: ../../error.php");
    
}
$result=read();

if($method == 'read') {
header('location: ../../models/method/readone.php?stationId='.$stationId);
    exit;
}    
if($format == 'json') {
		header('Content-type: application/json');
		$json=array_to_json($result);
	}
	else if($format == 'xml'){
		header('Content-type: application/xml');
		$xml = new SimpleXMLElement('<ships/>');
        array_to_xml( $result, $xml, "ship" );
        print($xml->asXML());
	}
    else if($format == 'csv'){
		$csv=array_to_csv($result);
	}else{
        header('Content-type: application/xml');
		$xml = new SimpleXMLElement('<ships/>');
        array_to_xml( $result, $xml, "ship" );
        print($xml->asXML());
    }


