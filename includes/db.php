<?php
//Default Connection

$connection = mysqli_connect('localhost','root','@28August1991','cms');

if (!$connection) {
    echo "Connection to server failed";
}

//Connection with MSSQL
// $serverName = "DESKTOP-26LT05H\\ISQL"; //serverName\instanceName
// $connectionInfo = array( "Database"=>"cms");
// $connection = sqlsrv_connect( $serverName, $connectionInfo);

// if( !$connection ) {
//      echo "Connection could not be established.<br />";
//      die( print_r( sqlsrv_errors(), true));
// }


?>
