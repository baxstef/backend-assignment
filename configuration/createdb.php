<?php
include("/connection.php");
$db = new dbObj();
$connection =  $db->getConnstring();

$sql_ship_positions=
"CREATE TABLE IF NOT EXISTS `ship_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `mmsi` int(11) NOT NULL COMMENT 'mmsi',
  `status` int(11) NOT NULL COMMENT 'status',
  `stationId` int(11) NOT NULL COMMENT 'stationId',
  `speed` int(11) NOT NULL COMMENT 'speed',
  `lon` float(6) NOT NULL COMMENT 'lon',
  `lat` float(6) NOT NULL COMMENT 'lat',
  `course` int(11) NOT NULL COMMENT 'course',
  `heading` int(11) NOT NULL COMMENT 'heading',
  `rot` varchar(255) NOT NULL COMMENT 'rote',
  `timestamp` int(11) NOT NULL COMMENT 'timestamp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ship_positions table'  ";

$result_ship_positions=mysqli_query($connection, $sql_ship_positions);


$sql_user=
"CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `ip` char(255) NOT NULL COMMENT 'ip',
  `countip` int(11) NOT NULL COMMENT 'countip',
  `timeuser` TIMESTAMP NOT NULL COMMENT 'timeuser',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='user table' ";

$result_sql_user=mysqli_query($connection, $sql_user);

if($result_sql_user){
    echo "ok";
}else{
    echo "error ".mysqli_connect_error();
}