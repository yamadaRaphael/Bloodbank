<?php

//set up connection to bloodbankdb database

//define connection parameters
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "bloodbankdb";

//use PDO (PHP Data Objects)API
//use  exception handling mode (try{}-catch{})
 try{
 	//define connection object
 	$dbConn  = new PDO("mysql:host =$serverName;dbname=$dbName",$userName,$password);
 	
 	//define error mode
 	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	
 	//print "Connected";
 	
 }
 
 catch(PDOException $ex){
 	//report error if connection failed
 	print $ex->getMessage();
 	
 }


?>