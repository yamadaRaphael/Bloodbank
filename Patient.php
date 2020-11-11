<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body style="background-color: pink">
	
	<h1 style="text-align: center">Patient Table</h1><br />
	<h4>Insert Values In Patient Table</h4>
	<form action="" method="post">
   	
	<label>Disease ID:</label>
	<p><input type="text" name="DiseaseID" /> </p>
	
	<label>BloodType ID:</label>
	<p><input type="text" name="BloodTypeID" /> </p>
	
	<label>Department ID:</label>
	<p><input type="text" name="DepID" /> </p>
	
	<label>Last Name:</label>
	<p><input type="text" name="LastName" /> </p>
	
	<label>First Name:</label>
	<p><input type="text" name="FirstName" /> </p>
	
	<label>Age(in yrs):</label>
	<p><input type="text" name="Age" /> </p>
	
	<p><input type="reset" name="reset" value="Reset" /> &nbsp; &nbsp;
	<input type="submit" name="submit" value="Insert" /></p>

</form>
<?php
//require db connection script

if(isset($_POST['submit'])){
	require_once "bloodbank_connect.php";
	$DiseaseID=$_POST['DiseaseID'];
	$BloodTypeID=$_POST['BloodTypeID'];
	$DepID=$_POST['DepID'];
	$LastName=$_POST['LastName'];
	$FirstName=$_POST['FirstName'];
	$Age=$_POST['Age'];
	
	global $dbConn;
	
//insert query statement
$insert = "INSERT INTO Patient(DiseaseID,BloodTypeID,DepID,LastName,FirstName,Age) VALUES(:DiseaseID,:BloodTypeID,:DepID,:LastName,:FirstName,:Age)";

try{
	//prepare Query
	$statement = $dbConn->prepare($insert);
	
	//bind values to filed names
	$statement->bindValue(':DiseaseID',$DiseaseID);
	$statement->bindValue(':BloodTypeID',$BloodTypeID);
	$statement->bindValue(':DepID',$DepID);
	$statement->bindValue(':LastName',$LastName);
	$statement->bindValue(':FirstName',$FirstName);
	$statement->bindValue(':Age',$Age);
	
	//execute Query
	$statement->execute();
	
	//release db connector
	$statement->closeCursor();
	
}
catch(PDOException $ex){
	//get error Message
	$ex->getMessage();
	
}
function get_results(){
global $dbConn;	

$select = "SELECT * FROM Patient
				ORDER BY PatientID";
				
//use PDO try-catch to run Query
try{
	//prepare query statement
	$statement = $dbConn->prepare($select);

//execute Query
	$statement->execute();
	
//fetcch query results
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

//release db connector Cursor
$statement->closeCursor();

//return result
return $results;

}
catch(PDOException $ex){
	//get error Message
	$ex->getMessage();
	
}
}
$myresults =get_results();

//Displaying Patient table

print "<table border=1><tr><td>PatientID</td><td>DiseaseID</td><td>BloodTypeID</td><td>DepID</td><td>LastName</td><td>FirstName</td><td>Age</td></tr>";
for($i=0;$i<count($myresults);$i++){
	$fetched=$myresults[$i];
    print "<tr><td>".$fetched['PatientID']."</td><td>".$fetched['DiseaseID']."</td><td>".$fetched['BloodTypeID']."</td><td>".$fetched['BloodTypeID']."</td><td>".$fetched['LastName']."</td><td>".$fetched['FirstName']."</td><td>".$fetched['Age']."</td></tr>";

	}		

print "</table>";

}
?>
<br /><br />	
<a href="bloodbank_user_interface.php">Click here to go back to main page</a><br>


</body>
</html>